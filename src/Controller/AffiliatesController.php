<?php
// src/Controller/AffiliatesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class AffiliatesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow(['add', 'logout', 'activate', 'forgotPassword', 'resetPassword', 'resetEmail']);
    }

        
     public function index() {
        $affiliates = $this->Affiliates->find('all');
        $this->set(compact('affiliates'));
        //debug($affiliates);
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Affiliate'));
        }

        $affiliate = $this->Affiliates->get($id);
        $this->set(compact('affiliate'));
    }

    public function add() {
        $affiliate = $this->Affiliates->newEntity($this->request->data);
        
        if($this->request->is('post')){
            if($result = $this->Affiliates->save($affiliate)){
                $this->Flash->success(__('The affiliate has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the affiliate.'));
        }
        
        $this->set(compact('affiliate'));
    }

    public function edit($id=null){
        $affiliate = $this->Affiliates->findById($id)->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Affiliates->patchEntity($affiliate, $this->request->data());
            if ($result = $this->Affiliates->save($affiliate)) {
                $this->Flash->success(__('The affiliate has been updated.'));
                return $this->redirect(['action' => 'view', $affiliate->id]);
            }
            $this->Flash->error(__('Unable to update the affiliate.'));
        }
        $this->set(compact('affiliate'));
    }
}
?>