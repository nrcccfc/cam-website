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
        $membershipClasses = $this->MembershipClasses->find('all')->contain(['Affiliates']);
        $this->set(compact('membershipClasses'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid MembershipClass'));
        }

        $membershipClass = $this->MembershipClasses->find()->where(['MembershipClasses.id'=>$id])->contain(['Affiliates'])->first();
        debug($membershipClass);
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
        $affiliates = $this->MembershipClasses->Affiliates->find('list')->toArray();
        $this->set(compact('membershipClass', 'affiliates'));
    }

    public function edit($id=null){
        $membershipClass = $this->MembershipClasses->findById($id)->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->MembershipClasses->patchEntity($membershipClass, $this->request->data());
            if ($result = $this->MembershipClasses->save($membershipClass)) {
                $this->Flash->success(__('The membership class has been updated.'));
                return $this->redirect(['action' => 'view', $membershipClass->id]);
            }
            $this->Flash->error(__('Unable to update the membership class.'));
        }
        $affiliates = $this->MembershipClasses->Affiliates->find('list')->toArray();
        $this->set(compact('membershipClass', 'affiliates'));
    }
}
?>