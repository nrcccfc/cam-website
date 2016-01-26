<?php
use \Cake\Auth\AbstractPasswordHasher;
use \Cake\Utility\Security;

class LegacyPasswordHasher extends AbstractPasswordHasher {

    public function hash($password) {
        return Security::sha1($password);
    }

    public function check($password, $hashed) {
        return Security::sha1($password) === $hashed;
    }
}
?>