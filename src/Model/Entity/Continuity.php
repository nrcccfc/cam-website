<?php
// src/Model/Entity/Continuity.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Continuity extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];
    // ...

    protected function _getName() {
        return explode(',', $this->_properties['start_date'])[0].' - '.explode(',', $this->_properties['end_date'])[0];
        //return 'NameFromEntity';
    }

/*
    protected function _setStartDate($start_date) {
        return $start_date['year'].'-'.$start_date['month'].'-'.$start_date['day'];
    }

    protected function _setEndDate($end_date) {
        return $end_date['year'].'-'.$end_date['month'].'-'.$end_date['day'];
    }
*/
    // ...
}
?>