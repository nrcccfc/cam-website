<?php
// src/Controller/PermissionsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;


class PermissionsController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $permissions = $this->Permissions->find('all');

        $resources = $this->Permissions->Resources->find('list');
        debug($resources);
        $this->set(compact('permissions'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid permission'));
        }

        $permission = $this->Permissions
            ->find()
            ->where(['Permissions.id' => $id])
            ->contain(['Publishers', 'Games'])
            ->first();
        $this->set(compact('permission'));
    }

    public function add() {
        $permission = $this->Permissions->newEntity($this->request->data);
        if($this->request->is('post')){
            //debug($this->request->data);
            if($result = $this->Permissions->save($permission)){
                $this->Flash->success(__('The permission has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to create the permission.'));
        }
        $games = $this->Permissions->Games->find('list')->toArray();
        $publishers = $this->Permissions->Publishers->find('list')->toArray();
        $this->set(compact('permission', 'publishers', 'games'));
    }

    public function edit($id=null){
        $permission = $this->Permissions
            ->find()
            ->where(['Permissions.id' => $id])
            ->contain(['Publishers', 'Games'])
            ->first();
        //$permission = $this->Permissions->findById($id)->contains(['Members', 'Roles'])->first();
        //debug($permission);
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Permissions->patchEntity($permission, $this->request->data());
            if ($result = $this->Permissions->save($permission)) {
                $this->Flash->success(__('The permission has been updated.'));
                return $this->redirect(['action' => 'view', $permission->id]);
            }
            $this->Flash->error(__('Unable to update the permission.'));
        }
        $publishers = $this->Permissions->Publishers->find('list')->toArray();
        $games = $this->Permissions->Games->find('list')->toArray();
        $this->set(compact('permission', 'publishers', 'games'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $permission = $this->Permissions->get($id);
        if ($this->Permissions->delete($permission)) {
            $this->Flash->success(__('The {0} Permission (Id:{1}) has been deleted.', [h($permission->name), h($permission->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }

}
?>