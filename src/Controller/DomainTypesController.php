<?php
// src/Controller/DomainTypesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class DomainTypesController extends AppController {

    public $helpers = ['Link'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $domainTypes = $this->DomainTypes->find('all')->contain(['Parent', 'Affiliates']);
        $this->set(compact('domainTypes'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid DomainType'));
        }

        $domainType = $this->DomainTypes
            ->find()
            ->where(['DomainTypes.id' => $id])
            ->contain(['Parent', 'Children', 'Affiliates'])
            ->first();
        $this->set(compact('domainType'));

    }

    public function add($id=null) {
        if(!is_null($id)){
            $this->request->data['parent_id'] = $id;
        }        
        $domainType = $this->DomainTypes->newEntity($this->request->data);

        if($this->request->is('post')){
            //Make sure the parent DomainType is of the same affiliate
            $domainType->parent_affiliate = $this->DomainTypes->getParentAffiliateId($this->request->data['parent_id']);

            //Make sure the name is unique within the affiliate
            $domainType->is_unique = $this->DomainTypes->isNameUniqueInAffiliate('', $this->request->data['name'], $domainType->affiliate_id);

            if($result = $this->DomainTypes->save($domainType)){
                $this->Flash->success(__('The DomainType has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the domain type.'));

        }
        
        $affiliates = $this->DomainTypes->Affiliates->find('list')->toArray();
        $parents = $this->DomainTypes->find('list')->toArray();
        $this->set(compact('domainType', 'parents', 'affiliates'));
    }

    public function edit($id=null){
        $domainType = $this->DomainTypes->findById($id)->first();

        if ($this->request->is(['post', 'put'])) {
            //Make sure the parent DomainType is of the same affiliate
            //$domainType->parent_affiliate_id = $this->DomainTypes->getParentAffiliateId($this->request->data['parent_id']);
            $domainType->parent_affiliate_id = null;
            //Make sure the name is unique within the affiliate
            $domainType->is_unique= $this->DomainTypes->isNameUniqueInAffiliate($domainType->name, $this->request->data['name'], $domainType->affiliate_id);
            
            //Update the object with request data.
            $this->DomainTypes->patchEntity($domainType, $this->request->data());
            if ($result = $this->DomainTypes->save($domainType)) {
                $this->Flash->success(__('The domain type has been updated.'));
                return $this->redirect(['action' => 'view', $domainType->id]);
            }
            $this->Flash->error(__('Unable to update the domain type.'));
        }

        $parents = $this->DomainTypes->getContextNameList($domainType->id);
        $affiliates = $this->DomainTypes->Affiliates->find('list')->toArray();
        $this->set(compact('domainType', 'parents', 'affiliates'));
    }
}
?>