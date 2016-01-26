<?php
// src/Controller/RolesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class RolesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        //debug($this->{$this->name});
        //debug($this->request->action);
        //debug($this->request->controller);
        $roles = $this->Roles->find()->contain(['Parent', 'DomainTypes.Affiliates']);
        //debug($roles->toArray());
        $this->set(compact('roles'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Role'));
        }

        $role = $this->Roles
            ->find()
            ->where(['Roles.id' => $id])
            ->contain(['Parent', 'Children', 'DomainTypes', 'Resources'=>function($q){
                return $q->order(['name'=>'ASC']);
            }])
            ->first();
        //debug($role->toArray());
        $this->set(compact('role'));
    }

    public function add($parentId=null) {
        $role = $this->Roles->newEntity($this->request->data, ['associated'=>['Resources']]);

        if(!is_null($parentId)){
            $role->parent_id = (int)$parentId;
            $role->parent_affiliate_id = $this->Roles->getAffiliateId($role->parent_id);
        }

        if($this->request->is('post')){
            //debug($this->Roles->find()->where(['Roles.id'=>$role['parent_id']])->first());
            //debug($this->request);
            //$role['parent_affiliate_id'] = $this->Roles->find()->where(['Roles.id'=>$role['parent_id']])->first()['affiliate_id'];

            debug($role);

            if($result = $this->Roles->save($role)){
                $this->Flash->success(__('The role has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the role.'));
       }else{
            $role->role_limit = 0;
        }
        //debug($role);
        $parents = $this->Roles->find('list')->toArray();

        if(!is_null($parentId)){
            //debug($role->toArray());
            //$domain_types = $this->Roles->DomainTypes->find('list')->where(['DomainTypes.affiliate_id'=>$role->parent_affiliate_id])->toArray();
            $domain_types = $this->Roles->DomainTypes->getContextNameList(null, $role->parent_affiliate_id);
            //debug($domain_types);
            $disable = false;
            if (count($domain_types) == 1) {
                $disable = true;
            }
        } else {
            //$domain_types = $this->Roles->DomainTypes->find('list')->toArray();
            $domain_types = $this->Roles->DomainTypes->getContextNameList();
        }
        $this->set(compact('role', 'parents', 'domain_types', 'parentId', 'disable'));
    }


    public function edit($id=null){
        $role = $this->Roles->find()->where(['Roles.id'=>$id])->contain(['Resources', 'Parent.Resources'])->first();
        //debug($role);
        if ($this->request->is(['post', 'put'])) {
            //$parentResources = $resources = $this->Roles->Parent->Resources->getContextList($role->parent->resources);


            //Update the object with request data.
            $this->Roles->patchEntity($role, $this->request->data(), ['associated' => ['Resources']]);
            if ($result = $this->Roles->save($role)) {
                $this->Flash->success(__('The role has been updated.'));
                return $this->redirect(['action' => 'view', $role->id]);
            }
            $this->Flash->error(__('Unable to update the role.'));
        }
        $parents = $this->Roles->find('list')->toArray();
        $domain_types = $this->Roles->DomainTypes->find('list')->toArray();
        debug($domain_types);

        $parentResources = null;
        if(!empty($role->parent)){
            $parentResources = $role->parent->resources;
        }
        $resources = $this->Roles->Resources->getContextList($parentResources);
        //$ownerResources = $resources;
        //debug($resources);

        //debug($this->Roles->Resources);
        $this->set(compact('role', 'parents', 'domain_types', 'resources'));
    }
}
?>