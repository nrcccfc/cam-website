<?php
// src/Controller/ContinuitiesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class ContinuitiesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow(['add', 'logout', 'activate', 'forgotPassword', 'resetPassword', 'resetEmail']);
    }

        
     public function index() {
        $continuities = $this->Continuities->find('all');
        $this->set(compact('continuities'));
        //debug($continuities);
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Continuity'));
        }

        //continuity = $this->Continuities->get($id);
        $continuity = $this->Continuities->find()->where(['id'=>$id])->contain('Games')->first();
        //debug($continuity->games);
        $this->set(compact('continuity'));
    }

    public function add() {
        $continuity = $this->Continuities->newEntity($this->request->data, ['associated' => ['Games']]);
        
        if($this->request->is('post')){
            if($result = $this->Continuities->save($continuity, ['associated' => ['Games']])){
                $this->Flash->success(__('The continuity has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the continuity.'));
        }
        $games = $this->Continuities->Games->getGamesList();
        $this->set(compact('continuity', 'games'));
    }

    public function edit($id=null){
        $continuity = $this->Continuities->find()->where(['id'=>$id])->contain('Games')->first();

        if ($this->request->is(['post', 'put'])) {
            $this->Continuities->patchEntity($continuity, $this->request->data(), ['associated'=>['Games']]);
            if ($result = $this->Continuities->save($continuity, ['associated'=>['Games']])) {
                $this->Flash->success(__('The continuity has been updated.'));
                return $this->redirect(['action' => 'view', $continuity->id]);
            }
            $this->Flash->error(__('Unable to update the continuity.'));
        }

        $games = $this->Continuities->Games->getGamesList();
        $this->set(compact('continuity', 'games')); 
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $continuity = $this->Continuities->get($id);
        if ($this->Continuities->delete($continuity)) {
            $this->Flash->success(__('The {0} Continuity (Id:{1}) has been deleted.', [h($continuity->name), h($continuity->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>