<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
//use Cake\ORM\TableRegistry;
//use Cake\Utility\Inflector;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components this controller uses.
 *
 * Component names should not include the `Component` suffix. Components
 * declared in subclasses will be merged with components declared here.
 *
 * @var array
 */

/*
    public $components = [
        //'Session',
        //'Gourmet/TwitterBootstrap.Flash',
        'Auth' => [
            'loginAction' => [
                'controller' => 'Members',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'home',
                'home'
            ],
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'userModel'=>'Members',
                    'fields' => ['username' => 'email'],
                    'scope' => ['Members.is_active' => true],
                ],
                //'Basic' => ['userModel'=>'Members'],
            ],
            //'authError' => 'Email/Password wrong, or account not activated.',
            'authError' => 'You are unable to access this area. Life isn\'t always fair.',
        ],
        //'Csrf' => ['secure' => false],
        'Access',
        'Paginator',
        'PrgPattern',
        'Ajax',
    ];
*/
    //public $helpers = [
    //    'Access',
        /*'Gourmet/TwitterBootstrap.Form' => [
            'widgets' => [
                'autocomplete' => [
                    'App\View\Widget\Autocomplete',
                    'text',
                    'label',
                    '_view',
                ]
            ],
            'templates' => [
                'autocomplete' => '<input type="text" name="{{name}}"{{attrs}}><input type="hidden" name="{{name}}id"{{attrs}}>',
            ],
        ],*/
        
    //];

    public function initialize()
    {
        parent::initialize();
        //debug($this->request);
        if ($this->request->params['controller'] != 'Members'){
            //Configure::write("test", $this->request->url );
            //debug(Configure::read("test") );
            //$this->set('intended_url', $this->request->url);
            $this->request->session()->write('intended_url', '/'.$this->request->url);
        }
        

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth', [
            'authorize' =>'Controller',
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Members',
                    'fields' => ['username' => 'email'],
                    'scope' => ['Members.is_active' => true],
                ],
            ],
            'loginAction' => ['plugin'=> null, 'controller' => 'Members', 'action' => 'login'],
            //'loginRedirect' => ['controller' => 'Pages', 'action' => 'home'],
            'logoutRedirect' => ['plugin' => null, 'controller' => 'Pages', 'action' => 'home'],
            'authError' => 'You are unable to access this area. Life isn\'t always fair.',
        ]);
        $this->loadComponent('Csrf');
        $this->loadComponent('Access');
        $this->loadComponent('Paginator');
        $this->loadComponent('PrgPattern');
        $this->loadComponent('Ajax');
        $this->loadComponent('Flash');
        // debug($this->request->session()->read('intended_url') );

        

    }


    public function beforeFilter(Event $event) {

    	parent::beforeFilter($event);
        //$this->Auth->allow(['autoComplete']);
        //debug($this->request->session()->read());
    }

	public function isAuthorized($member) {
        //$this->Access->timeTrial($this->request, 1000);
        $forceUpdate = false;
        $accessPackage = $this->Access->getAccessPackage($this->request, $forceUpdate);
        $hasAccess = $this->Access->check($accessPackage);
        $this->set('access', $accessPackage);

        //debug($hasAccess?'Access Granted':'Access Denied');
        return $hasAccess;
	}

    //General AutoComplete method.
    public function autoComplete(){
        //debug($this->request->post);
        $this->Ajax->autoComplete();
    }

    protected function getOwnerRecordId() {
        $member_id = $this->request->session()->read('Auth.User.id');
        debug($member_id);
        $result = null;
        //$this->table = TableRegistry::get($this->controller->modelClass);
        //debug($this->table->columns());

        if($member_id){
            $modelName = $this->modelClass;
            //debug($this->$modelName->columns());
            $record =  $this->$modelName->find()
                    ->where([$this->request->params['controller'].'.member_id' => $member_id])
                    ->first();
        }
        if(!empty($record)){
            return $record->id;
        } else {
            return null;
        }
        
    }

    protected function redirectToOwnerId($actions = [], $createRecord = false){
        $this->loadComponent('Flash');
        foreach($actions as $action){
            //debug($action);
            if(empty($this->request->params['pass']) && $this->request->params['action'] == $action){
                $record_id = $this->getOwnerRecordId();
                if ($record_id){
                    return $this->redirect(['action' => $this->request->params['action'], $record_id]);
                    //debug("Redirecting");
                } else {
                    //This means the member doesnt have a record to redirect to.
                    //debug('hey');
                    
                    $this->Flash->error(__('Member does not own a {0} record. Please contact your Admin.', $this->request->params['controller']));
                    $this->redirect(['controller' => 'Pages', 'action' => 'home']);
                    return;
                }
            }
        }   
    }

}
