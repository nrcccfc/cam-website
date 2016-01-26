<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AnnouncementsTable extends AppTable {

    public function initialize(array $config){
        parent::initialize($config);
        $this->belongsTo('Domains');
    }

    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('title')
            ->notEmpty('body');

        return $validator;
    }

	public function isOwnedBy($announcementId, $userId) {
	    return $this->exists(['id' => $announcementId, 'user_id' => $userId]);
	}
}
?>