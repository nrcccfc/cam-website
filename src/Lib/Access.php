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
 * @since         1.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Lib;

use Cake\ORM\TableRegistry;

/**
 * String handling methods.
 *
 */
class Access {

	public function initialize(){
		debug($this->testing());
	}



	public function testing() {
		//$this->Session = new SessionComponent();
		//debug($this->Session);
		return 'Access Lib Loaded';
	}

    public function check(array $accessPackage) {
        //Admins have full access
        $adminResult = $this->adminAccessCheck($accessPackage);
        if ($adminResult){
            //debug("Admin Mode");
            return true;
        }

        $resourceResult = $this->resourceAccessCheck($accessPackage);
        $domainResult = $this->domainAccessCheck($accessPackage);
        
        //debug('Resource Result: '.$resourceResult);
        //debug('Domain Result: '.$domainResult);

        $hasAccess = false;
        if ($resourceResult && $domainResult){
            $hasAccess = true;
        } else {
            $ownerResult = $this->ownerAccessCheck($accessPackage);
            //debug('Owner Result: '.$ownerResult);
            $hasAccess = $ownerResult;
        }
        return $hasAccess;
    }

    public static function adminAccessCheck(array $accessPackage){
        foreach($accessPackage['roles'] as $role){
            if ($role['role_id'] == 1){
                return true;
            }
        }
        return false;
    } 

    public static function resourceAccessCheck(array $accessPackage){
        $target = $accessPackage['controller'].':'.$accessPackage['action'];
        //debug($target);
        //debug($accessPackage);
        if (isset($accessPackage['resources'][$target])){
        	return true;
        }
        return false;
    }


    public static function domainAccessCheck(array $accessPackage){
        //Get the recored Id
        if( !empty($accessPackage['id']) ){
        	$target = $accessPackage['controller'].':'.$accessPackage['action'];
            $id = $accessPackage['id'];
            $table = TableRegistry::get($accessPackage['controller']);
            $columns = $table->schema()->columns();
            $has_domain_id = in_array('domain_id',  $columns);
            $has_venue_id = in_array('venue_id',  $columns);
            if($has_domain_id || $has_venue_id){
            	//debug('full Domain Check');

            	//Get the Domain
                $select = ['id'];
                if ($has_domain_id) array_push($select, 'domain_id');
                if ($has_venue_id) array_push($select, 'venue_id');
                $record = $table
                    ->find()
                    ->where(['id'=>$id])
                    ->select($select)
                    ->first()
                ;
                
                //Domain ID Check
                if(!empty($record)){
	                $domainPath = $table->Domains->find('path', ['for'=>$record->domain_id])->select(['id'])->toArray();
	                foreach($domainPath as $domain){
						if(isset($accessPackage['resources'][$target][$domain->id])){
	                		return true;
	                	}
	                }
	                return false;
                }

            }
        }
        return true;
    }

    public static function ownerAccessCheck(array $accessPackage){
        $target = $accessPackage['controller'].':'.$accessPackage['action'].':*';
        //debug($target);
        //debug($accessPackage);
        if (isset($accessPackage['resources'][$target])){

            //Now check to see if the record actually belongs to you...
            $table = TableRegistry::get($accessPackage['controller']);
            $record = $table->find()->where(['id'=>$accessPackage['id']])->first();
            if($record){
                //debug($record->member_id === $accessPackage['member_id']);
                return $record->member_id === $accessPackage['member_id'];
            }
            //debug($record->member_id);
            debug("Access Granted because you own it!");
            //return true;
        }
        return false;
    }
}
