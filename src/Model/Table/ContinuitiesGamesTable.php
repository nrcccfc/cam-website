<?php
namespace App\Model\Table;
 
use Cake\Validation\Validator;
use Cake\ORM\Table;
 
class ContinuitiesGamesTable extends AppTable {
 
	public function initialize(array $config) {
		parent::initialize($config);	 
		$this->addBehavior('Timestamp');
		
		$this->belongsTo('Games');
		$this->belongsTo('Continuities');
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->requirePresence('game_id')
			->notEmpty('continuity_id')
		;
	}
 
}