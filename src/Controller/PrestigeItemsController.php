<?php
// src/Controller/PrestigeItemsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class PrestigeItemsController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $prestigeItems = $this->PrestigeItems->find('all')->contain(['PrestigeCategories', 'Affiliates', 'Roles', 'DomainTypes']);
        //debug($prestigeItems->toArray());
        $this->set(compact('prestigeItems'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid prestigeItem'));
        }

        $prestigeItem = $this->PrestigeItems
            ->find()
            ->where(['PrestigeItems.id' => $id])
            ->contain(['PrestigeCategories', 'Affiliates', 'DomainTypes', 'Roles'])
            //->contain(['DomainTypes'])
            ->first();
        //debug($prestigeItem);
        $this->set(compact('prestigeItem'));
    }

    public function add() {
        $prestigeItem = $this->PrestigeItems->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->PrestigeItems->save($prestigeItem)){
                $this->Flash->success(__('The prestigeItem has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the prestigeItem.'));
        }

        $resources = $this->request->session()->read('Auth.User.Access.resources')[$this->request->params['controller'].':'.$this->request->params['action']];
        $affiliateIds = [];
        foreach($resources as $domainId=>$roleId){
            $affiliateId = $this->PrestigeItems->Affiliates->getAffiliateIdByDomainId($domainId);
            if(is_null($affiliateId)){
                //This means that the resource is for Prime and thus, we need to just show all the affiliate ids. Admin should really be the only ones to get this...
                $affiliateIdList = $this->PrestigeItems->Affiliates->find('list')->select(['id'])->toArray();
                $affiliateIds = [];
                foreach($affiliateIdList as $newAffiliateId=>$name){
                    array_push($affiliateIds, $newAffiliateId);
                }
                break;
            }
            array_push($affiliateIds, $affiliateId);
        }



        $affiliates = $this->PrestigeItems->Affiliates->find('list')->where(['id IN'=>$affiliateIds])->toArray();
        $prestigeCategories = $this->PrestigeItems->PrestigeCategories->find('list')->toArray();
        $domainTypes = $this->PrestigeItems->DomainTypes->getContextNameList(null, $affiliateIds);
        $roles = $this->PrestigeItems->getRolesList();
        $this->set(compact('prestigeItem', 'affiliates', 'prestigeCategories', 'domainTypes', 'roles'));
    }

    public function edit($id=null){


        //These should be limited by the role that allows you to view the page in the first place. If its a CaM role, then only display CaM domain types.

        $prestigeItem = $this->PrestigeItems
            ->find()
            ->where(['PrestigeItems.id' => $id])
            ->contain(['Affiliates', 'PrestigeCategories', 'DomainTypes', 'Roles'])
            ->first();

        //debug($prestigeItem->toArray());
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->PrestigeItems->patchEntity($prestigeItem, $this->request->data());
            if ($result = $this->PrestigeItems->save($prestigeItem)) {
                $this->Flash->success(__('The prestigeItem has been updated.'));
                return $this->redirect(['action' => 'view', $prestigeItem->id]);
            }
            $this->Flash->error(__('Unable to update the prestigeItem.'));
        }



        $resources = $this->request->session()->read('Auth.User.Access.resources')[$this->request->params['controller'].':'.$this->request->params['action']];
        $affiliateIds = [];
        foreach($resources as $domainId=>$roleId){
            $affiliateId = $this->PrestigeItems->Affiliates->getAffiliateIdByDomainId($domainId);
            if(is_null($affiliateId)){
                //This means that the resource is for Prime and thus, we need to just show all the affiliate ids. Admin should really be the only ones to get this...
                $affiliateIdList = $this->PrestigeItems->Affiliates->find('list')->select(['id'])->toArray();
                $affiliateIds = [];
                foreach($affiliateIdList as $newAffiliateId=>$name){
                    array_push($affiliateIds, $newAffiliateId);
                }
                break;
            }
            array_push($affiliateIds, $affiliateId);
        }

        //debug($affiliateIds);
        //$affiliateIds = array(2);

        $affiliates = $this->PrestigeItems->Affiliates->find('list')->where(['id IN'=>$affiliateIds])->toArray();
        $prestigeCategories = $this->PrestigeItems->PrestigeCategories->find('list')->toArray();
        //$domainTypes = $this->PrestigeItems->DomainTypes->find('list')->toArray();

        $domainTypes = $this->PrestigeItems->DomainTypes->getContextNameList(null, $affiliateIds);

        $roles = $this->PrestigeItems->getRolesList($affiliateIds);
        //debug($roles->toArray());
        $this->set(compact('prestigeItem', 'affiliates', 'prestigeCategories', 'domainTypes', 'roles'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $prestigeItem = $this->PrestigeItems->get($id);
        if ($this->PrestigeItems->delete($prestigeItem)) {
            $this->Flash->success(__('The {0} PrestigeItem (Id:{1}) has been deleted.', [h($prestigeItem->name), h($prestigeItem->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>