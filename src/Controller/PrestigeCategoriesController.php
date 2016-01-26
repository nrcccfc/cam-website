<?php
// src/Controller/prestigeCategoriesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class PrestigeCategoriesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $prestigeCategories = $this->PrestigeCategories->find('all')->contain('Affiliates');
        $this->set(compact('prestigeCategories'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid prestigeCategory'));
        }

        $prestigeCategory = $this->PrestigeCategories
            ->find()
            ->where(['prestigeCategories.id' => $id])
            ->contain(['Affiliates'])
            ->first();
        $this->set(compact('prestigeCategory'));
    }

    public function add() {
        $prestigeCategory = $this->PrestigeCategories->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->PrestigeCategories->save($prestigeCategory)){
                $this->Flash->success(__('The prestigeCategory has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the prestigeCategory.'));
        }
        $affiliates = $this->PrestigeCategories->Affiliates->find('list')->toArray();
        $this->set(compact('prestigeCategory', 'affiliates'));
    }

    public function edit($id=null){
        $prestigeCategory = $this->PrestigeCategories
            ->find()
            ->where(['prestigeCategories.id' => $id])
            ->contain(['Affiliates'])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->PrestigeCategories->patchEntity($prestigeCategory, $this->request->data());
            if ($result = $this->PrestigeCategories->save($prestigeCategory)) {
                $this->Flash->success(__('The prestigeCategory has been updated.'));
                return $this->redirect(['action' => 'view', $prestigeCategory->id]);
            }
            $this->Flash->error(__('Unable to update the prestigeCategory.'));
        }
        $affiliates = $this->PrestigeCategories->Affiliates->find('list')->toArray();
        $this->set(compact('prestigeCategory', 'affiliates'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $prestigeCategory = $this->PrestigeCategories->get($id);
        if ($this->PrestigeCategories->delete($prestigeCategory)) {
            $this->Flash->success(__('The {0} Book (Id:{1}) has been deleted.', [h($prestigeCategory->name), h($prestigeCategory->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>