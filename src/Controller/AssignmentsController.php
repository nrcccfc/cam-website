<?php
// src/Controller/AssignmentsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class AssignmentsController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $assignments = $this->Assignments->find('all')->contain(['Members', 'Roles', 'Domains', 'Venues'=>['Domains', 'Games']]);
        $this->set(compact('assignments'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid assignment'));
        }

        $assignment = $this->Assignments
            ->find()
            ->where(['Assignments.id' => $id])
            ->contain(['Members', 'Roles', 'Domains', 'Venues'=>['Domains', 'Games']])
            ->first();
        $this->set(compact('assignment'));
    }

    public function add() {
        $assignment = $this->Assignments->newEntity($this->request->data);
        if($this->request->is('post')){
            //debug($this->request->data);
            $assignment->isVenueSpecific = $this->Assignments->Roles
                ->find()
                ->where(['id'=>$assignment->role_id])
                ->select(['id', 'is_venue_specific'])
                ->first()->is_venue_specific;
            debug($assignment);
            if($result = $this->Assignments->save($assignment)){
                $this->Flash->success(__('The assignment has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the assignment.'));
            
        }

        $members = $this->Assignments->Members->find('list')->toArray();
        $roles = $this->Assignments->Roles->find('list')->toArray();
        $domains = $this->Assignments->Domains->find('list')->toArray();
        $venues = $this->Assignments->Venues->find('list')->contain('Games')->toArray();
        $this->set(compact('assignment', 'members', 'roles', 'domains', 'venues'));
    }

    public function edit($id=null){
        $assignment = $this->Assignments
            ->find()
            ->where(['Assignments.id' => $id])
            ->contain(['Members', 'Roles', 'Domains'])
            ->first();

        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Assignments->patchEntity($assignment, $this->request->data());

            $currentRole = $this->Assignments->Roles
                ->find()
                ->where(['id'=>$assignment->role_id])
                ->select(['id', 'is_venue_specific'])
                ->first()
                ->toArray()
                ;
            $assignment->isVenueSpecific = $currentRole['is_venue_specific'];




            if ($result = $this->Assignments->save($assignment)) {
                $this->Flash->success(__('The assignment has been updated.'));
                return $this->redirect(['action' => 'view', $assignment->id]);
            }
            $this->Flash->error(__('Unable to update the assignment.'));
        }
        $members = $this->Assignments->Members->find('list')->toArray();
        $roles = $this->Assignments->Roles->find('list')->toArray();
        $domains = $this->Assignments->Domains->find('list')->toArray();
        $venues = $this->Assignments->Venues->find('list')->contain('Games')->toArray();

        $this->set(compact('assignment', 'members', 'roles', 'domains', 'venues'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $assignment = $this->Assignments
            ->find()
            ->where(['Assignments.id' => $id])
            ->contain(['Domains', 'Roles', 'Venues.Games'])
            ->first();
        if ($this->Assignments->delete($assignment)) {
            $this->Flash->success(__('The "{0}" assignment has been deleted.', [h($assignment->name)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>