<?php
// src/Model/Entity/Domain.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Domain extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

}
?>