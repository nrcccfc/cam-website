<?php
// src/Model/Entity/Member.php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;

class Member extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true, 'id'=>false];

	protected $_hidden = ['password', 'password_temp', 'password_confirm'];
    // ...

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }


    protected $_virtual = [
        'full_name'
    ];

    protected function _getFullName() 
    {
        $fullName = null;
        if(!empty($this->_properties['first_name']) && !empty($this->_properties['first_name'])) {
            $fullName = $this->_properties['first_name'].' '.$this->_properties['last_name'];
        }
        return $fullName;
    }

    // ...
}
?>