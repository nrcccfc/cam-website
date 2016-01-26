<?php
// src/Controller/GamesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class GamesController extends AppController {

    public $helpers = ['Link'];
    //public $components = [];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
    public function index() {
        $games = $this->Games->find('all')->contain(['Parent', 'Children', 'Books.Publishers']);
        $this->set(compact('games'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Game'));
        }

        $game = $this->Games
            ->find()
            ->where(['Games.id' => $id])
            ->contain(['Parent', 'Children'])
            ->first();
        $this->set(compact('game'));
    }

    public function add($parentId=null) {
        $game = $this->Games->newEntity($this->request->data);

        if(!is_null($parentId)){
            $game->parent_id = $parentId;
        }

        if($this->request->is('post')){
            if($result = $this->Games->save($game)){
                $this->Flash->success(__('The game has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the game.'));
        }else{
            $game->allow_multiple = false;
        }
        
        $parents = $this->Games->find('list')->toArray();
        $this->set(compact('game', 'parents'));
    }

    public function edit($id=null){
        $game = $this->Games->findById($id)->first();
        if ($this->request->is(['post', 'put'])){
            //Update the object with request data.
            $this->Games->patchEntity($game, $this->request->data());
            if ($result = $this->Games->save($game)) {
                $this->Flash->success(__('The game has been updated.'));
                return $this->redirect(['action' => 'view', $game->id]);
            }
            $this->Flash->error(__('Unable to update the game.'));
        }
        $parents = $this->Games->find('list')->toArray();
        $this->set(compact('game', 'parents'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $game = $this->Games->get($id);
        if ($this->Games->delete($game)) {
            $this->Flash->success(__('The {0} Game (Id:{1}) has been deleted.', [h($game->name), h($game->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }
}
?>