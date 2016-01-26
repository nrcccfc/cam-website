<?php
// src/Controller/ResourcesController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use ReflectionClass;
use ReflectionMethod;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;


class ResourcesController extends AppController {

    //public $helpers = ['Url'];
    //public $components = ['Random'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        //$this->Auth->allow(['add', 'logout', 'activate', 'forgotPassword', 'resetPassword', 'resetEmail']);
    }

        
     public function index() {
        $resources = $this->Resources->find('all')->order(['name'=>'ASC']);
        $this->set(compact('resources'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Resource'));
        }

        $resource = $this->Resources->get($id);
        $this->set(compact('resource'));
    }

    public function add() {
        $resource = $this->Resources->newEntity($this->request->data);
        if($this->request->is('post')){
            if($result = $this->Resources->save($resource)){
                $this->Flash->success(__('The resource has been created.'));
                return $this->redirect(['action' => 'view', $result->id]);
            }
            $this->Flash->error(__('Unable to add the resource.'));
        }
        $this->set(compact('resource'));
    }

    public function edit($id=null){
        $resource = $this->Resources->findById($id)->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Resources->patchEntity($resource, $this->request->data());

            if ($result = $this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been updated.'));
                return $this->redirect(['action' => 'view', $resource->id]);
            }
            $this->Flash->error(__('Unable to update the resource.'));
        }
        $this->set(compact('resource'));
    }

    public function update() {
        if($this->request->is('post')) {
            $results = [];
            if(!empty($this->request->data['Resources'])){
                foreach($this->request->data['Resources'] as $resource=>$v){
                    if($v){
                        array_push($results, ['name'=>$resource]);
                    }
                }
                $count = 0;
                $expectedCount = count($results);
                foreach($results as $result){
                    $newResource = $this->Resources->newEntity();
                    $this->Resources->patchEntity($newResource, $result);
                    if($result = $this->Resources->save($newResource)){
                        $count++;
                    }
                }
                if($count == $expectedCount){
                    $this->Flash->success(__('The {0}/{1} Resources have been Added.', [h($count), h($expectedCount)]));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Only {0}/{1} Resources have been Added.', [h($count), h($expectedCount)]));                
            }

        }

        $resourceNames = $this->Resources->getResources(true, false);
        //debug($resourceNames);
        $ownableResourceNames = $this->Resources->getResources(true, true);
//debug("Need to Add Ownable Options")



        //debug($ownableResourceNames);
        $resources = [];
        foreach($resourceNames as $controllers){
            foreach($controllers as $controller => $actions){
                 foreach($actions as $action){
                    $name = $controller.':'.$action;
                    array_push($resources, $name);
                 }
            }
        }

        $ownableResources = [];
        foreach($ownableResourceNames as $controllers){
            foreach($controllers as $controller => $actions){
                 foreach($actions as $action){
                    $name = $controller.':'.$action.':*';
                    array_push($resources, $name);
                 }
            }
        }

        //Remove current resources.
        $currentResources = $this->Resources->find('list')->toArray();
        $resource = array_diff($resources, $currentResources);
        sort($resource);
        //debug($currentResources);
        //debug($resources);
        $this->set(compact('resource'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);
        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('The "{0}" Resource (Id:{1}) has been deleted.', [h($resource->name), h($resource->id)]));
            return $this->redirect(['action' => 'index']);
        }
    }
}
?>