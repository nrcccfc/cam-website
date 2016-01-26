<?php
// src/Controller/MembersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;
use Cake\Utility\String;
use Cake\I18n\Time;
use Cake\Network\Email\Email;
use Cake\Auth\DefaultPasswordHasher;


class MembersController extends AppController {

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Random');
        $this->loadComponent('Cookie');
    }

    //public $helpers = ['Access'];
    //public $components = ['Random', 'Cookie'];


    public $timestamp_duration = 24; //In Hours

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'logout', 'activate', 'forgotPassword', 'resetPassword', 'resetEmail']);
        $this->eventManager()->off($this->Csrf);
    }

        
    public function index() {

        //debug($this->request->is('post'));

        $this->PrgPattern->redirect();
        $this->PrgPattern->decode();
        //debug($this->request->params);


        if(!empty($this->request->params['data'])){
            //Now lets setup the conditions
            $conditions = [];
            $query = '';
            $count = 10;

            //Set things up so the form values are set when the page reloads.
            $this->request->data = $this->request->params['data'];

            

            //Setup the Conditions
            if(!empty($this->request->data['Members']['username_id'])){
                $conditions['Members.id']  = $this->request->data['Members']['username_id'];
            } else {
                if(!empty($this->request->data['Members']['username'])){
                    $conditions['Members.username LIKE']  = '%'.str_replace("+", " ", $this->request->data['Members']['username']).'%';
                }
            }

            if(!empty($this->request->data['count'])){
                $count = $this->request->data['count'];
            }


            $query = $this->Members->find('all')->where($conditions)->limit($count);
            //debug($query->first());
            $this->set('members', $this->paginate($query));
            //$members = $this->Members->find('all');
            //$this->set(compact('members'));
        }
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid member'));
        }

        $member = $this->Members
            ->find()
            ->where(['id'=>$id])
            ->contain(['Assignments'=>['Roles', 'Domains', 'Venues.Games']])
            ->first()
            ;
        $this->set(compact('member'));
    }


    public function register() {
        $member = $this->Members->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $member->code = $this->Random->str_random(60);
            $member->code_timestamp = Time::now()->addMinutes($this->timestamp_duration*60)->getTimestamp(); //Member will have 24 hours to click the link
            $member->is_proxy = false;
            if ($result = $this->Members->save($member)) {

                //Send the account activation email
                $email = new Email('default');
                $email
                    ->template('register', 'default')
                    ->emailFormat('both')
                    ->to($member->email)
                    ->from('camarilla.system@gmail.com')
                    ->subject(__('Camarilla Website: Account Activation'))
                    ->viewVars(['code'=>$member->code, 'username'=>$member->username, 'duration'=>$this->timestamp_duration])
                    ->send();

                $this->Flash->success(__('The member has been saved and a conformation email sent.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the member.'));
        }
        $domains = $this->Members->Domains
            ->find('list')
            ->contain(['DomainTypes'])
            ->join([
                'table' => 'domain_types',
                'alias' => 'dt',
                'type' => 'left',
                'conditions' => 'Domains.domain_type_id = dt.id'
                ])
            ->where(['DomainTypes.allow_members'=>true])
            ->toArray();
        $this->set(compact('member', 'domains'));
    }

    public function add(){
         $member = $this->Members->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $member->code = $this->Random->str_random(60);
            $member->code_timestamp = Time::now()->addMinutes($this->timestamp_duration*60)->getTimestamp(); //Member will have 24 hours to click the link
            $member->is_proxy = true;
            $member->ignorePassword = true;

            if ($result = $this->Members->save($member)) {
                $creator = $this->request->session()->read('Auth.User.first_name').' '.$this->request->session()->read('Auth.User.last_name');
                //Send the account activation email
                $email = new Email('default');
                $email
                    ->template('add_member', 'default')
                    ->emailFormat('both')
                    ->to($member->email)
                    ->from('camarilla.system@gmail.com')
                    ->subject('Camarilla Website: Account Activation')
                    ->viewVars(['code'=>$member->code, 'creator'=>$creator, 'duration'=>$this->timestamp_duration])
                    ->send();

                $this->Flash->success(__('The member account has been added and a conformation email has been sent to them.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Unable to add the member.'));
        }

        $domains = $this->Members->Domains
            ->find('list')
            ->contain(['DomainTypes'])
            ->join([
                'table' => 'domain_types',
                'alias' => 'dt',
                'type' => 'left',
                'conditions' => 'domains.domain_type_id = dt.id'
                ])
            ->where(['DomainTypes.allow_members'=>true])
            ->toArray();
        $this->set(compact('member', 'domains'));
    }

    public function edit($id=null){
        $member = $this->Members
            ->find()
            ->where(['is_active'=>true, 'id'=>$id])
            ->first();
        if ($this->request->is(['post', 'put'])) {
            //Update the object with request data.
            $this->Members->patchEntity($member, $this->request->data());
            if ($result = $this->Members->save($member)) {
                $this->Flash->success(__('The member has been updated.'));
                return $this->redirect(['action' => 'view', $member->id]);
            }
            $this->Flash->error(__('Unable to update the member.'));
        }
        $this->set(compact('member'));
    }

    public function editEmail(){
       $member = $this->Members
            ->find()
            ->where(['email'=>$this->Auth->user('email'), 'is_active'=>true])
            ->first();
        //Since so much of our security depends on a working email, this needs to be very secure.
        if ($this->request->is(['post', 'put'])) {
            //Make sure we have a member entity from the email & that the password matches.
            if ($member){
                //Generate a new confirm code
                $member->code = $this->Random->str_random(60);
                $member->code_timestamp = Time::now()->addMinutes($this->timestamp_duration*60)->getTimestamp(); //Member will have 30 mins to click the link

                $member->email_temp = $this->request->data['email_temp'];
                $member->current_password = $member->password;
                $member->email_password = $this->request->data['email_password'];

                //This check is to check the email_temp against the email column.
                //Then it will be passed into the validator so the errors show up properly.
                $member->email_unique = $this->Members
                    ->find()
                    ->where(['email'=>$member->email_temp])
                    ->count();

                if($result = $this->Members->save($member)){
                    //Send the 'reset_email' email to the member
                    $email = new Email('default');
                    $email
                        ->template('edit_email', 'default')
                        ->emailFormat('both')
                        ->to($member->email_temp)
                        ->from('camarilla.system@gmail.com')
                        ->subject('Camarilla Website: Update Email')
                        ->viewVars(['code'=>$member->code, 'username'=>$member->username, 'duration'=>$this->timestamp_duration])
                        ->send();

                    $this->Flash->success(__('An update request has been sent containing a link to update your email.'));
                    return $this->redirect(['action' => 'view', $member->id]);
                } else {
                    $this->Flash->error(__('Could not sent recovery email, try again.'));
                }
                
            } else {
                $this->Flash->error(__('Invalid password or account has not yet been activated, try again.'));
            }
        }
        $this->set(compact('member'));
    }

    public function resetEmail($code=null){
        //Get the member that matches the provided code.      
        $member = null;

        if($code != null){ //If no member, then check if there is a code.
             $member = $this->Members
                ->find()
                ->where(['code'=>$code, 'is_active'=>true])
                ->first();

            //Check to make sure the timestamp is still active.
            $now = Time::now();
            if($member->code_timestamp < $now){
                $member = null;
            }
        }
        if($member){ //Make sure we actually got a match

            $member->email                = $member->email_temp;
            $member->email_temp           = null;
            $member->code                 = null;
            $member->code_timestamp       = null;

            debug($member);
            if ($result = $this->Members->save($member)) {
            
                //Update the Auth User
                if($this->Auth->user() != null){
                    $member = $this->Members
                        ->find()
                        ->where(['id'=>$this->Auth->user('id')])
                        ->first();
                    $this->Auth->setUser($member);
                }
                $this->Flash->success(__('Your email has been updated.'));
                return $this->redirect(['action' => 'view', $member->id]);
            } else {
                $this->Flash->error(__('Your email could not be updated. Please try again.'));
            }
            $this->set(compact('member', 'is_logged_in'));
        } else {
            $this->Flash->error(__('There are no accounts in recovery with a matching active password activation code.'));
            return $this->redirect(['action' => 'login']);
        }
    }
    
	public function login() {
        //debug($this->request->referer());
        //debug($this->request);
        $referer = $this->request->session()->read('intended_url');
        //debug($referer);
        if(is_null($referer) || $referer == '/' ){
            $referer = ['controller'=>'Pages', 'action'=>'home'];
        }
        if($this->Auth->user()){
            //return $this->redirect(['controller'=>'Pages', 'action'=>'home']);
            
            return $this->redirect($referer);
        }


        if ($this->request->is('get') && $this->Cookie->check('Auth.user')) {
            $cookie = $this->Cookie->read('Auth.user');
            //debug($cookie);
            $this->request->data['email'] = $cookie['email'];
            $this->request->data['password'] = $cookie['password'];
            $this->request->data['used_cookie'] = true;
        }

        //Check to see if we have the needed data
	    if ($this->request->is('post') || !empty($this->request->data)) {
	        $member = $this->Auth->identify();
	        if ($member) {
	            $this->Auth->setUser($member);
                if(!empty($this->request->data) && isset($this->request->data['remember_me']) && $this->request->data['remember_me']){
                    $this->Cookie->write('Auth.user', ['email'=>$this->request->data['email'], 'password'=>$this->request->data['password']]);
                    unset($this->request->data['remember_me']);
                }

                //Redirect to referrer if login was handled by a cookie.
                if(isset($this->request->data['used_cookie'])){
                    //return $this->redirect($this->Auth->redirectUrl());
                    return $this->redirect($referer);
                }
                //return $this->redirect(['controller'=>'Pages', 'action'=>'home']);
                return $this->redirect($referer);
	        }
	        $this->Flash->error(__('Invalid email/password or account has not been activated, try again'));
	    }
	}

	public function logout() {
        //Delete the cookie
        if($this->Cookie->check('Auth.user')){
            $this->Cookie->delete('Auth.user');
        }
	    return $this->redirect($this->Auth->logout());
	}

    public function activate($code){

        $now = Time::now();
        $member = $this->Members
            ->find()
            ->where(['is_active'=>false, 'code'=>$code])
            ->first();

        
        if($member){
            $isProxy = $member->is_proxy;
            //Set member to active and clear the activation code.

            if($this->request->is(['post', 'put'])) {
                $this->Members->patchEntity($member, $this->request->data());
            }
            debug($member->password);
            debug(!empty($member->password));
            if(!empty($member->password)) {
                if($member->code_timestamp > $now){
                    $member->is_active = true;
                    $member->code = null;
                    $member->code_timestamp = null;
                    $member->is_proxy = false;

                    if($result = $this->Members->save($member)){
                        $this->Flash->success(__('Your account has been activated. Please login.'));
                    } else {
                        //debug($member);
                        $this->Flash->error(__('Your account could not be activated.'));
                    }
                } else {
                    //This timestamp has expired and the account has not been activated. Delete the account.
                    $this->Members
                        ->query()
                        ->delete()
                        ->where(['id'=>$member->id, 'is_active'=>false, 'is_proxy'=>false])
                        ->execute();
                    $this->Flash->error(__('You have not activated your account within the alloted {0} hours. Account has been purged. Please try again.', $this->timestamp_duration));
                }
                return $this->redirect(['action' => 'login']);
            }
        } else {
            $this->Flash->error(__('There are no inactive accounts that match that activation code.'));
            return $this->redirect(['action' => 'login']);
        }
        $this->set(compact('member'));
    }

    public function forgotPassword(){
        if ($this->request->is('post')) {
            $member = $this->Members
                ->find()
                ->where(['email'=>$this->request->data['email'], 'is_active'=>true])
                ->first();

            //Make sure we have a member entity from the email.
            if ($member) {
                //Generate a new confirm code
                $member->code = $this->Random->str_random(60);
                $member->code_timestamp = Time::now()->addMinutes($this->timestamp_duration*60)->getTimestamp(); //Member will have 30 mins to click the link

                if($result = $this->Members->save($member)){

                    //Send the 'forgot password' email to the member
                    $email = new Email('default');
                    $email
                        ->template('reset_password', 'default')
                        ->emailFormat('both')
                        ->to($member->email)
                        ->from('camarilla.system@gmail.com')
                        ->subject('Camarilla Website: Reset Password')
                        ->viewVars(['code'=>$member->code, 'username'=>$member->username, 'duration'=>$this->timestamp_duration])
                        ->send();

                    $this->Flash->success(__('A recovery email has been sent containing a link to recover your password.'));
                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('Could not sent recovery email, try again.'));
                }
            } else {
                $this->Flash->error(__('Invalid email or account has not yet been activated, try again.'));
            }
        }
    }

    public function resetPassword($code=null){
        //Get the member that matches the provided code.

        //Used to setup the view depending on how you get here.
        $is_logged_in                       = $this->Auth->user() != null;        
        $member                               = null;

        if($is_logged_in){ //Try to fetch the member entity from the Auth session id.
            $member = $this->Members
                ->find()
                ->where(['id'=>$this->Auth->user('id')])
                ->first();
        } elseif($code != null){ //If no member, then check if there is a code.
             $member = $this->Members
                ->find()
                ->where(['code'=>$code, 'is_active'=>true])
                ->first();

            //Check to make sure the timestamp is still active.
            $now = Time::now();
            if($member->code_timestamp < $now){
                $member = null;
            }
        }

        if($member){ //Make sure we actually got a match
            if ($this->request->is(['post', 'put'])) {
                if($is_logged_in){
                    $member->old_password     = $this->request->data['old_password'];
                    $member->current_password = $member->password;
                }
                $member->new_password         = $this->request->data['new_password'];
                $member->new_password_confirm = $this->request->data['new_password_confirm'];
                $member->password             = $this->request->data['new_password'];
                $member->code                 = null;
                $member->code_timestamp       = null;
                if ($result = $this->Members->save($member)) {
                    
                    //Update the Auth User
                    if($is_logged_in){
                        $member = $this->Members
                            ->find()
                            ->where(['id'=>$this->Auth->user('id')])
                            ->first();
                        $this->Auth->setUser($member->toArray());
                    }
                    $this->Flash->success(__('Your password has been updated.'));
                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('Your password could not be updated. Please try again.'));
                }
            }
            $this->set(compact('member', 'is_logged_in'));
        } else {
            $this->Flash->error(__('There are no accounts in recovery with a matching active password activation code.'));
            return $this->redirect(['action' => 'login']);
        }
    }
}
?>