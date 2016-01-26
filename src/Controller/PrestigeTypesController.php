<?php
// src/Controller/PrestigeTypesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class PrestigeTypesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $prestigeTypes = $this->PrestigeTypes->find('all');
        $this->set(compact('prestigeTypes'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid prestigeType'));
        }

        $prestigeType = $this->PrestigeTypes
            ->find()
            ->where(['PrestigeTypes.id' => $id])
            ->first();
        $this->set(compact('prestigeType'));
    }

    public function add() {
        $prestigeType = $this->PrestigeTypes->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->PrestigeTypes->save($prestigeType)){
                $this->Flash->success(__('The prestigeType has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the prestigeType.'));
        }
        $this->set(compact('prestigeType'));
    }

    public function edit($id=null){
        $prestigeType = $this->PrestigeTypes
            ->find()
            ->where(['PrestigeTypes.id' => $id])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->PrestigeTypes->patchEntity($prestigeType, $this->request->data());
            if ($result = $this->PrestigeTypes->save($prestigeType)) {
                $this->Flash->success(__('The prestigeType has been updated.'));
                return $this->redirect(['action' => 'view', $prestigeType->id]);
            }
            $this->Flash->error(__('Unable to update the prestigeType.'));
        }
        $this->set(compact('prestigeType'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $prestigeType = $this->PrestigeTypes->get($id);
        if ($this->PrestigeTypes->delete($prestigeType)) {
            $this->Flash->success(__('The {0} PrestigeType (Id:{1}) has been deleted.', [h($prestigeType->name), h($prestigeType->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>