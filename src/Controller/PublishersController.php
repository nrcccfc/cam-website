<?php
// src/Controller/PublishersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class PublishersController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $publishers = $this->Publishers->find('all');
        $this->set(compact('publishers'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Publisher'));
        }

        $publisher = $this->Publishers->get($id);
        $this->set(compact('publisher'));
    }

    public function add() {
        $publisher = $this->Publishers->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->Publishers->save($publisher)){
                $this->Flash->success(__('The publisher has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the publisher.'));
        }
        $this->set(compact('publisher'));
    }

    public function edit($id=null){
        $publisher = $this->Publishers->findById($id)->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Publishers->patchEntity($publisher, $this->request->data());
            if ($result = $this->Publishers->save($publisher)) {
                $this->Flash->success(__('The publisher has been updated.'));
                return $this->redirect(['action' => 'view', $publisher->id]);
            }
            $this->Flash->error(__('Unable to update the publisher.'));
        }
        $this->set(compact('publisher'));
    }
}
?>