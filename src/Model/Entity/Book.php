<?php
// src/Model/Entity/Book.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Book extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

	//protected $_hidden = ['password', 'password_temp', 'password_confirm'];
}
?>