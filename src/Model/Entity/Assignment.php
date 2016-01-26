<?php
// src/Model/Entity/Assignment.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Assignment extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];

/*
    public function generateName($assignment){
            //Check the venue to see if there are any listed.
            $letter = $assignment->domain->domain_type->abbreviation; //For Domain
            $venueName = '';
            if(!empty($assignment->venue)){
                if(empty($assignment->domain->children)){
                    $letter = 'V';
                }
                $venueName = ':'.$assignment->venue->name;
            }
            $roleName = str_replace('*', $letter, $assignment->role->abbreviation);
            return $assignment->domain->name.':'.$roleName.$venueName;
    }
*/
    protected $_virtual = [
    	'name'
    ];

    protected function _getName() {
    	//Get the Letter

        if(!empty($this->venue->name)){
            $venueName = '|'.$this->venue->name;
        }else{
            $venueName = null;
        }
        
        if(!empty($this->domain->name) ){
            $domainName = $this->domain->name;
        } else {
            $domainName = 'Unknown';
        }

        if(!empty($this->role->abbreviation) ){
            $role = $this->role->abbreviation;
        } else {
            $role = 'Unknown';
        }
        return $domainName.'|'.$role.$venueName;
    }

}
?>