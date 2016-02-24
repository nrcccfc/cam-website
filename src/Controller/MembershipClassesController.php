<?php
// src/Controller/MembershipClassesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class MembershipClassesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $membershipClasses = $this->MembershipClasses->find('all')->contain(['Affiliates', 'Roles']);
        $this->set(compact('membershipClasses'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid MembershipClass'));
        }

        $membershipClass = $this->MembershipClasses->find()->where(['MembershipClasses.id'=>$id])->contain(['Affiliates', 'Roles'])->first();
        //debug($membershipClass);
        $this->set(compact('membershipClass'));
    }

    public function add() {
        $membershipClass = $this->MembershipClasses->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->MembershipClasses->save($membershipClass)){
                $this->Flash->success(__('The membership class has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the membership class.'));
        }
        $affiliateId = $this->MembershipClasses->Affiliates->getAffiliateIdByDomainId($this->request->session()->read('Auth.User.domain_id'));
        $affiliates = $this->MembershipClasses->Affiliates->find('list')->where(['Affiliates.id'=>$affiliateId])->toArray();
        $roles = $this->MembershipClasses->Roles->getRolesByAffiliate($affiliateId);
        $this->set(compact('membershipClass', 'affiliates', 'roles'));
    }

    public function edit($id=null){
        $membershipClass = $this->MembershipClasses->findById($id)->contain(['Roles'])->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->MembershipClasses->patchEntity($membershipClass, $this->request->data());
            if ($result = $this->MembershipClasses->save($membershipClass)) {
                $this->Flash->success(__('The membership class has been updated.'));
                return $this->redirect(['action' => 'view', $membershipClass->id]);
            }
            $this->Flash->error(__('Unable to update the membership class.'));
        }
        $affiliateId = $this->MembershipClasses->Affiliates->getAffiliateIdByDomainId($this->request->session()->read('Auth.User.domain_id'));
        $affiliates = $this->MembershipClasses->Affiliates->find('list')->where(['Affiliates.id'=>$affiliateId])->toArray();
        $roles = $this->MembershipClasses->Roles->getRolesByAffiliate($affiliateId);
        $this->set(compact('membershipClass', 'affiliates', 'roles'));
    }
}
?>