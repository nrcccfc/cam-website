<?php
// src/Model/Table/VenuesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class VenuesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);
        
        $this->displayField('name');

        $this->belongsTo('Continuities');
        $this->belongsTo('Games');
        $this->belongsTo('Domains');
        $this->hasMany('Assignments', [
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
            //->requirePresence('email')
            ->notEmpty('continuity_id', 'A continuity is required')
            ->notEmpty('game_id', 'A game is required')
            ->notEmpty('domain_id', 'A domain is required')
            ;
    }
}
?>