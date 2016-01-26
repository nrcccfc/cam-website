<?php
// src/Model/Entity/Venue.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Venue extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];

/*
    public function getName($venue){
        if(!empty($venue)){
            return $venue->domain->name.'-'.$venue->game->name;
        }
        return null;
    }
*/

    protected $_virtual = [
    	'name'
    ];

    protected function _getName() {
    	if(!empty($this->game->name)){
    		return $this->game->name;
    	}
    	return null;
    }

}
?>