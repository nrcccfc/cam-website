<?php
// src/Model/Table/ContinuitiesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContinuitiesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);
        $this->displayField('name');

        $this->belongsToMany('Games', 
            [
                //'saveStrategy' => 'append',
                'targetForeignKey' => 'game_id',
                'foreignKey' => 'continuity_id',
                'joinTable' => 'continuities_games',
            ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
        /*
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Affiliate name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            ->notEmpty('abbreviation', 'An abbriviation is required')
            ->add('abbreviation', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Affiliate abbreviation must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 2, 6],
                    'message' => 'Abbreviation must be between 2 and 6 characters long.'
                ]
            ])
            ->notEmpty('description', 'An description for this affiliate is required')
        */
        ;
    }
}
?>