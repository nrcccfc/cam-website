<?php
// src/Controller/DomainsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class DomainsController extends AppController {

    public $helpers = ['Link'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow([]);
    }

        
     public function index() {
        $domains = $this->Domains->find('all')->contain(['Parent', 'DomainTypes']);
        $this->set(compact('domains'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Domain'));
        }

        $domain = $this->Domains
            ->find()
            ->where(['Domains.id' => $id])
            ->contain(['Parent', 'Children', 'DomainTypes'])
            ->first();
        $this->set(compact('domain'));
    }

    public function add($parentId=null) {
        $domain = $this->Domains->newEntity($this->request->data);
        if($this->request->is('post')){
            //Make sure the parent DomainType is of the same affiliate
            //$domainType->parent_affiliate_id = $this->DomainTypes->getParentAffiliate($this->request->data['parent_id'])->id;

            //Make sure the name is unique within the affiliate
            //$domainType->is_unique= $this->DomainTypes->isNameUniqueInAffiliate($domainType->name, $this->request->data['name'], $domainType->affiliate_id);

            if(!is_null($parentId)){
                $domain->parent_id = $parentId;
            }

            //Update color with custom color if empty
            if(empty($this->request->data['color']) && !empty($this->request->data['custom_color'])){
                $domain->color = $this->request->data['custom_color'];
            }

            if($result = $this->Domains->save($domain)){
                $this->Flash->success(__('The Domain has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the domain.'));
        }

        $domainTypes = $this->Domains->getContextNameList($parentId);
        $parents = $this->Domains->find('list')->toArray();
        $colors = $this->Domains->getColorsList();
        $this->set(compact('domain', 'parents', 'domainTypes', 'colors'));
    }

    public function edit($id=null){
        $domain = $this->Domains->findById($id)->first();
        if ($this->request->is(['post', 'put'])) {
            //Make sure the parent DomainType is of the same affiliate
            //$domainType->parent_affiliate_id = $this->DomainTypes->getParentAffiliate($this->request->data['parent_id'])->id;

            //Make sure the name is unique within the affiliate
            //$domainType->is_unique= $this->DomainTypes->isNameUniqueInAffiliate($domainType->name, $this->request->data['name'], $domainType->affiliate_id);
            
            //Update the object with request data.
            $this->Domains->patchEntity($domain, $this->request->data());
            if ($result = $this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been updated.'));
                return $this->redirect(['action' => 'view', $domain->id]);
            }
            $this->Flash->error(__('Unable to update the domain.'));
        }

        $domainTypes = $this->Domains->getContextNameList($domain->parent_id);
        $parents = $this->Domains->find('list')->toArray();
        $colors = $this->Domains->getColorsList();
        $this->set(compact('domain', 'parents', 'domainTypes', 'colors'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $domain = $this->Domains->get($id);
        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('The {0} Domain (Id:{1}) has been deleted.', [h($domain->name), h($domain->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }
}
?>