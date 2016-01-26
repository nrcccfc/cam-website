<?php
// src/Model/Table/ResourcesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Core\App;
use Cake\Core\Plugin;
use Cake\Controller\Controller;
use Cake\Utility\Inflector;
use Cake\Filesystem\Folder;
use ReflectionClass;
use ReflectionMethod;



class ResourcesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Tree');

        //Associations
        $this->belongsToMany('Roles', [
            'through'=>'Permissions',
        ]);

	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Resource name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 128],
                    'message' => __('Name must be between 3 and 128 characters long.'),
                ],
                'match' => [
                    'rule' => function($value, $context){
                        return stripos($value, ':') !== false;
                    },
                    'message' => 'Name must contain a \':\'',
                ]
            ])
            ;
    }

/*
    public function getControllers() {
        $files = scandir('../src/Controller/');
        $results = [];
        $ignoreList = [
            '.', 
            '..', 
            'Component', 
            'AppController.php', 
            'InitializeController.php'];
        foreach($files as $file){
            if(!in_array($file, $ignoreList)) {
                $controller = explode('.', $file)[0];
                array_push($results, str_replace('Controller', '', $controller));
            }            
        }
        return $results;
    }
*/

    public function getControllers($plugin = null, $prefix = null) {
        $ignoreList = [
            'AppController.php', 
            'InitializeController.php'];
        if (!$plugin) {
            $path = App::path('Controller' . (empty($prefix) ? '' : DS . Inflector::camelize($prefix)));
            $dir = new Folder($path[0]);
            $controllerFiles = $dir->find('.*Controller\.php');
        } else {
            $path = App::path('Controller' . (empty($prefix) ? '' : DS . Inflector::camelize($prefix)), $plugin);
            $dir = new Folder($path[0]);
            $controllerFiles = $dir->find('.*Controller\.php');
        }
        $results = [];
        foreach($controllerFiles as $file){
            if(!in_array($file, $ignoreList)) {
                $controller = explode('.', $file)[0];
                array_push($results, str_replace('Controller', '', $controller));
            }            
        }
        return $results;
    }

    public function getActions($controllerName) {
        $className = 'App\\Controller\\'.$controllerName.'Controller';
        $class = new ReflectionClass($className);
        $actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $results = [$controllerName => []];
        $ignoreList = ['initialize', 'beforeFilter', 'afterFilter'];
        foreach($actions as $action){
            if($action->class == $className && !in_array($action->name, $ignoreList)){
                array_push($results[$controllerName], $action->name);
            }
        }
        return $results;
    }

    public function getResources($onlyNew=false, $ownableOnly=false){

        //debug($this->getControllerList());
        $ignoreList = ['Pages'];
        $controllers = $this->getControllers();
        $resources = [];

        if($onlyNew){
            $currentResources = $this->find('list')->toArray();
            //debug($currentResources);
        }

        $actions = [];
        foreach($controllers as $controllerName){
            //debug($controllerName);
            $table = TableRegistry::get($controllerName);
            $ownable = false;

            if (!in_array($controllerName, $ignoreList)){
                //debug($table->schema()->column("member_id"));
                $ownable = $table->schema()->column("member_id") !== null;
            }

            $controllerActions = $this->getActions($controllerName);
            $validActions = [];
            if ($onlyNew){
                
                foreach($controllerActions as $actions){
                    $actionList = [];
                    foreach($actions as $action){
                        $resourceName = $controllerName.":".$action;
                        if (!in_array( $resourceName, $currentResources)){
                            array_push($actionList, $action);
                        }
                    }

                    //debug($resourceName);
                    //debug($actionList);
                }

                if (count($actionList)>0){
                    $validActions = array($controllerName=>$actionList);
                    //debug($validActions);
                }
            } else {
                $validActions = $controllerActions;
            }


            if(count($validActions)){
                if ($ownableOnly && $ownable) {
                    
                    array_push($resources, $validActions);
                    
                } else {
                    array_push($resources, $validActions);
                }
            }
        }
        //debug($resources);
        return $resources;
    }

    public function getContextList($parentResources=null) {
        $parentIds = [];
        if(!empty($parentResources)){
            //debug($parentResources);
            foreach($parentResources as $k=>$v){
                array_push($parentIds, $v->id);
            }
        }
        
        //debug($parentIds);
        $resources = $this->find('list')->toArray();
        $results = [];

        //debug($this->schema()->column('member_id') !== null);
        //debug($resources);

        foreach($resources as $k=>$v){
            $parts = explode(':', $v);
            //debug($parts);

            if(empty($parentIds) || in_array($k, $parentIds)){
                if(empty($results[$parts[0]])){
                    $results[$parts[0]] = [];
                }
                if ( count($parts) == 2 ){
                    $results[$parts[0]][$k] = $parts[1];
                } else {
                    $results[$parts[0]][$k] = $parts[1].": OwnRecord";
                }
                
            }
            
        }
        ksort($results);
        foreach($results as $k=>$v){
            asort($results[$k]);
        }
        return $results;
    }


    //Returns an array of values to initialize the database with.
    public function init() {
        return 
        [
            [
                    'alias' => 'root',
            ],
        ];
    }
}
?>