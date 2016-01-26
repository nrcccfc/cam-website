<?php
// src/Controller/VenuesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;


class VenuesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $venues = $this->Venues->find('all')->contain(['Games', 'Continuities', 'Domains']);
        //debug($venues->toArray());
        $this->set(compact('venues'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid venue'));
        }

        $venue = $this->Venues
            ->find()
            ->where(['Venues.id' => $id])
            ->contain(['Games', 'Continuities', 'Domains'])
            ->first();
        $this->set(compact('venue'));
        //debug($venue);
    }

    public function add() {
        $venue = $this->Venues->newEntity($this->request->data);
        if($this->request->is('post')){
            //debug($this->request->data);
            if($result = $this->Venues->save($venue)){
                $this->Flash->success(__('The venue has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the venue.'));
        }

        $games = $this->Venues->Games->getGamesList();
        $continuities = $this->Venues->Continuities->find('list')->toArray();
        $domains = $this->Venues->Domains->find('list')->toArray();
        $this->set(compact('venue', 'games', 'continuities', 'domains'));
    }

    public function edit($id=null){
        $venue = $this->Venues
            ->find()
            ->where(['Venues.id' => $id])
            ->contain(['Games', 'Continuities', 'Domains'])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Venues->patchEntity($venue, $this->request->data());
            if ($result = $this->Venues->save($venue)) {
                $this->Flash->success(__('The venue has been updated.'));
                return $this->redirect(['action' => 'view', $venue->id]);
            }
            $this->Flash->error(__('Unable to update the venue.'));
        }
        $games = $this->Venues->Games->getGamesList();
        $continuities = $this->Venues->Continuities->find('list')->toArray();
        $domains = $this->Venues->Domains->find('list')->toArray();
        $venues = null;
        $this->set(compact('venue', 'games', 'continuities', 'domains', 'venues'));
    }

}
?>