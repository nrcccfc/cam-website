<?php
// src/Model/Entity/Resource.php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class Resource extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];
}
?>