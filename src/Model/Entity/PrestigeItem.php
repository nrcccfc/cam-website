<?php
// src/Model/Entity/prestigeItem.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class prestigeItem extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];

    protected $_virtual = [
        'range'
    ];

    protected function _getRange() 
    {
        $result = null;
        if(!empty($this->_properties['value_min']) && !empty($this->_properties['value_max'])) {
            $result = '('.$this->_properties['value_min'].'-'.$this->_properties['value_max'].')';
        }
        return $result;
    }

}
?>