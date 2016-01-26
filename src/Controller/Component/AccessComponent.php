<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Network\Exception\ForbiddenException;
use Cake\ORM\TableRegistry;
use App\Lib\Access;
//use Cake\Datasource\ConnectionManager;

class AccessComponent extends Component {

	public $components = ['Auth'];

    var $request = null;

    public function beforeFilter() {
        $this->controller = $this->_registry->getController();
       // $this->request = $this->_registry->getController()->request;
        $this->request = $this->controller->request;
    }


    public function initialize(array $config){
        $this->Access = new Access();
    }

    public function check($accessPackage) {
        return $this->Access->check($accessPackage);
    }

    public function getAccessPackage($request, $forceUpdate=false){
        $accessPackage = $this->request->session()->read('Auth.User.Access');
        if($forceUpdate || empty($accessPackage) || !$this->is_current($accessPackage)){
            //debug('Force Update: '.$forceUpdate);
            //debug('Empty: '.empty($accessPackage) );
            //debug('Not Current: '.!$this->is_current($accessPackage) );
            //debug('Session Access needs to update.');
            $accessPackage = $this->updateAccessPackage();
        } else {
            //debug('Session Access is Current');
        }

        $id = empty($request->pass[0])?null:$request->pass[0];
        $accessPackage['controller'] = $request->controller;
        $accessPackage['action'] = $request->action;
        $accessPackage['id'] = empty($request->pass[0])?null:$request->pass[0];
        return $accessPackage;
    }

    public function is_current($accessPackage, $forceUpdate=false){
        $secondsTillUpdate = 60; //This should only run once every minute or so.
        $now = microtime(true);

        if($forceUpdate || $now - $this->request->session()->read('Auth.User.AccessUpdate') >= $secondsTillUpdate){
            //update AccessUpdate time
            //debug('Updating AccessUpdate Time');
            $this->request->session()->write('Auth.User.AccessUpdate', $now);
            $assignments = TableRegistry::get('Assignments')
                ->find('all')
                ->where(['Assignments.member_id'=>$this->request->session()->read('Auth.User.id')])
                
                //->matching('Assignments', function($q) use($memberId){
                //    return $q->where(['Assignments.member_id'=>$memberId]);
                //})
                //->select(['id', 'modified'])
                ->contain(['Roles'=>function($q){
                    return $q->select(['id', 'modified']);
                }])
                
            ;

            //debug('Assignment Count: '.count($assignments->toArray()));
            //debug('Role Count: '.count($accessPackage['roles']));
            $assignmentCount = count($assignments->toArray());
            //First check to see if the number of current roles and the number of assigned roles matches.
            if($assignmentCount == count($accessPackage['roles']) ){
                //Now make sure the assignemnts match the roles and the role modified matches the timestamp.
                $i = 0;
                foreach($assignments as $assignment){
                    foreach($accessPackage['roles'] as $role){
                        if ($assignment->role->id == $role['role_id'] && $assignment->role->modified == $role['timestamp']){
                            $i++;
                            break;
                        }
                    }
                }
                if($i != $assignmentCount){
                    return false;
                }
            }else{
                //Assignments do not match roles.
                return false;
            }
        }
        return true;
    }

    public function updateAccessPackage() {
        //debug('test');
        $results = [];
        //Load the resources for each member
        $members = TableRegistry::get('Members');
        $member = $members
            ->find()
            ->where(['Members.id'=>$this->Auth->user('id')])
            ->select('id')
            ->contain(['Assignments'=>['Roles'=>['Resources'], 'Domains'=>['Children', 'DomainTypes'], 'Venues'=>['Games']]])
            ->first();
        //debug($member);
        //Reformat array

        $results = ['roles'=>[], 'resources'=>[]];

        foreach($member->assignments as $assignment){
            $venueId = (!empty($assignment->venue->id)) ? $assignment->venue->id : null;
            $domainPath = $members->Assignments->Domains->find('path', ['for'=>$assignment->domain->id])->select(['id']);
            $domainIds = [];
            foreach($domainPath as $domain) {
                array_push($domainIds, $domain->id);
            }

            //debug($assignment);
            $result = [
                'name'          => $assignment->name,
                'timestamp'     => $assignment->role->modified,
                'role_id'       => $assignment->role->id,
                'venue_id'      => $venueId,
                'domain_id'     => $assignment->domain->id,
                'affiliate_id'  => $assignment->domain->domain_type->affiliate_id,
                'domain_path'   => $domainIds,
            ];
            array_push($results['roles'], $result);

            foreach($assignment->role->resources as $resource){
                if(empty($results['resources'][$resource->name])){
                    $results['resources'][$resource->name] = [];
                }
                foreach($domainIds as $domainId){
                    $results['resources'][$resource->name][$domainId] = $assignment->role->id;
                }
            }
            
        }
        $results['member_id'] = $this->Auth->user('id');
        $results['member_username'] = $this->Auth->user('username');
        //Sort the resources
        //debug($results['resources']);
        ksort($results['resources']);
        //debug($results['resources']);

        //debug($results);
        $this->request->session()->write('Auth.User.Access', $results);
        $this->request->session()->write('Auth.User.AccessUpdate', microtime(true));

        return $results;
    }

    public function timeTrial($request, $loops=1000, $isolate_lookup=false){
        $access = $this->getAccessPackage($request);
        
        $time_start= microtime(true);
        for($i=0; $i<$loops; $i++){
            if(!$isolate_lookup){
                $access = $this->getAccessPackage($request);
            }
            $this->check($access);
        }
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        $testType = $isolate_lookup?'Loopup Test':'Full Test';
        debug($testType.' - Total Execution Time: '.$execution_time.' Seconds');
    }

}
?>