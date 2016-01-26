<?php
// src/Controller/PrestigeLogsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;


class PrestigeLogsController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function initialize(){
        $this->redirectToOwnerId(['view'], true);


        //Default to users view
        //$ownedActions = ['view'];
        //debug($this->request->params);
        //debug($this);
        //$this->DefaultId->getRecordId(['view']);
        #debug($this->getOwnerRecordId());
        //$this->PrestigeLogs->defaultToMemberRecord(['view']);

        /*
        if(empty($this->request->params['pass']) && $this->request->params['action'] == "view"){
            $prestigeLogId = $this->PrestigeLogs
                ->find()
                ->where([$this->request->params['controller'].'.member_id' => $this->request->session()->read('Auth.User.id')])
                ->first()->id;
            debug($prestigeLogId);
            return $this->redirect(['action' => $this->request->params['action'], $prestigeLogId]);
        }

        //if (!$id) {
        //    throw new NotFoundException(__('Invalid prestigeLog'));
        //}
        */

        parent::initialize();
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $prestigeLogs = $this->PrestigeLogs->find('all')->contain(['Members']);
        $this->set(compact('prestigeLogs'));
    }

    public function view($id=null) {

        $searchConditions = ['PrestigeLogs.id' => $id];
        if(!$id){
            $member_id = $this->request->session()->read('Auth.User.id');
            $searchConditions = ['PrestigeLogs.member_id' => $member_id];
        }

        //debug($searchConditions);

        //if (!$id) {
        //    throw new NotFoundException(__('Invalid prestigeLog'));
        //}

        $prestigeLog = $this->PrestigeLogs
            ->find()
            ->where($searchConditions)
            ->contain(['Members', 
                    'PrestigeLogsItems'=> function ($q) {
                        return $q->order('prestigeLogsItems.locked', 'desc')
                            ->contain(['Domains', 
                                'PrestigeItems.PrestigeCategories'=>function($q){return $q->select(['id', 'monthly_limit', 'name']);}, 
                                    'Officers', 
                                    'Venues.Games'=>function($q){return $q->select(['id', 'name', 'abbreviation']);}]);
                    }
                ])
            ->first()
            //->toArray()
            ;
        //debug($prestigeLog);
        $prestigeTotal = $this->PrestigeLogs->calculatePrestige($prestigeLog);

        $statusList = $this->PrestigeLogs->PrestigeLogsItems->getPrestigeItemsStatusList();
        $this->set(compact('prestigeLog', 'statusList', 'prestigeTotal'));
    }

    public function approve() {
        $assignments = $this->request->session()->read('Auth.User.Access.roles'); //This is technically the assignments
        //debug($assignments);
        //Get all the jobs from the user and list all the items they could approve.
        $prestigeLogsItems = $this->PrestigeLogs->PrestigeLogsItems->getPrestigeItemsToBeApproved($assignments);
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $patched = $this->PrestigeLogs->PrestigeLogsItems->patchEntities($prestigeLogsItems, $this->request->data());
            //debug($patched);
            $valid = true;
            foreach($patched as $entity){
                //Update Locked Timestamp
                if($entity->status > 0){
                    $entity->locked = Time::now();
                }
                
                $result = $this->PrestigeLogs->PrestigeLogsItems->save($entity);
                if(!$result) $valid = false;
            }

            if ($valid) {
                $this->Flash->success(__('The Prestige Log Items has been updated.'));
                //return $this->redirect(['action' => 'approve']);
            }else{
                $this->Flash->error(__('Unable to update the prestigeLog.'));
            }
        }
        $prestigeLogsItems = $this->PrestigeLogs->PrestigeLogsItems->getPrestigeItemsToBeApproved($assignments);
        //debug(count($prestigeLogsItems));
        //debug($prestigeLogsItems);
        $approvalList = $this->PrestigeLogs->PrestigeLogsItems->getApprovalList();
        $officerId = $this->request->session()->read('Auth.User.id');
        //debug($officerId);
        $this->set(compact('prestigeLogsItems', 'approvalList', 'officerId'));
    }

    public function add() {
        $prestigeLog = $this->PrestigeLogs->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->PrestigeLogs->save($prestigeLog)){
                $this->Flash->success(__('The prestigeLog has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the prestigeLog.'));
        }
        $members = $this->PrestigeLogs->Members->find('list')->toArray();
        $this->set(compact('prestigeLog', 'members'));
    }

    public function addPrestige($id){
        $prestigeLogsItem = $this->PrestigeLogs->PrestigeLogsItems->newEntity($this->request->data);
        //debug($prestigeLogsItem);
        if($this->request->is('post')){
            $prestigeLogsItem->prestige_log_id = (int)$id;
            //debug($prestigeLogsItem);
            if($result = $this->PrestigeLogs->PrestigeLogsItems->save($prestigeLogsItem)){
                $this->Flash->success(__('The prestigeLogsItem has been created.'));
                return $this->redirect(['action' => 'view']);
            }
            $this->Flash->error(__('Unable to create the prestigeLogItem.'));
        }

        //debug($this->request->session()->read('Auth.User'));
        $affiliateId = $this->PrestigeLogs->PrestigeLogsItems->PrestigeItems->PrestigeCategories->Affiliates->getAffiliateIdByDomainId($this->request->session()->read('Auth.User.domain_id'));
        $members = $this->PrestigeLogs->Members->find('list')->toArray();
        $prestigeItems = $this->PrestigeLogs->PrestigeLogsItems->PrestigeItems->getPrestigeItemsList($affiliateId);
        $domains = $this->PrestigeLogs->PrestigeLogsItems->Domains->getContextNameListByAffiliate($affiliateId);
        $venues = $this->PrestigeLogs->PrestigeLogsItems->Venues->find('list')->contain(['Games'])->group(['Games.id'])->toArray();
        $this->set(compact('prestigeLogsItem', 'members', 'prestigeItems', 'domains', 'venues'));
    }

    public function editPrestige($id=null){

        $prestigeLog = $this->PrestigeLogs->get($id, 
            ['contain'=>[
                'Members.Domains',
                'PrestigeLogsItems'=> function ($q){
                    return $q->where(['status'=>0]);
                }
            ]]);

        //debug($prestigeLog);
        //debug($this->request->data());

        $prestigeLogsItems = $prestigeLog->prestige_logs_items;

        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $patched = $this->PrestigeLogs->PrestigeLogsItems->patchEntities($prestigeLogsItems, $this->request->data());
            $valid = true;
            foreach($patched as $entity){
                $result = $this->PrestigeLogs->PrestigeLogsItems->save($entity);
                if(!$result) $valid = false;
            }

            if ($valid) {
                $this->Flash->success(__('The Prestige Log Items has been updated.'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('Unable to update the prestigeLog.'));
        }


        $affiliateId = $this->PrestigeLogs->PrestigeLogsItems->PrestigeItems->PrestigeCategories->Affiliates->getAffiliateIdByDomainId($this->request->session()->read('Auth.User.domain_id'));
        $prestigeItems = $this->PrestigeLogs->PrestigeLogsItems->PrestigeItems->getPrestigeItemsList($affiliateId);
        $domains = $this->PrestigeLogs->PrestigeLogsItems->Domains->find('list')->toArray();
        $venues = $this->PrestigeLogs->PrestigeLogsItems->Venues->find('list')->contain(['Games'])->group(['Games.id'])->toArray();

        $this->set(compact('prestigeLog', 'prestigeLogsItems', 'prestigeItems', 'domains', 'venues'));

    }

    public function edit($id=null){
        $prestigeLog = $this->PrestigeLogs
            ->find()
            ->where(['PrestigeLogs.id' => $id])
            ->contain(['Members', 'PrestigeLogsItems'])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->PrestigeLogs->patchEntity($prestigeLog, $this->request->data());
            if ($result = $this->PrestigeLogs->save($prestigeLog)) {
                $this->Flash->success(__('The prestigeLog has been updated.'));
                return $this->redirect(['action' => 'view', $prestigeLog->id]);
            }
            $this->Flash->error(__('Unable to update the prestigeLog.'));
        }
        $members = $this->PrestigeLogs->Members->find('list')->toArray();
        $this->set(compact('prestigeLog', 'members'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $prestigeLog = $this->PrestigeLogs->get($id);
        if ($this->PrestigeLogs->delete($prestigeLog)) {
            $this->Flash->success(__('The {0} PrestigeLog (Id:{1}) has been deleted.', [h($prestigeLog->name), h($prestigeLog->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>