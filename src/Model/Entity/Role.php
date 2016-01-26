<?php
// src/Model/Entity/Role.php
namespace App\Model\Entity;

use Cake\ORM\Entity;


class Role extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];

    protected $_virtual = [
        'display_name'
    ];

}
?>