<?php
// src/Model/Table/prestigeTypesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PrestigeTypesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //Associations
        $this->belongsToMany('PrestigeItems', [
            'through'=>'PrestigeItemsTypes',
            'foreignKey' => 'prestige_type_id',
            'targetForeignKey' => 'prestige_item_id',
        ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
        /*
            ->add('role_id', [
                'validFormat' => [
                    'rule' => 'email',
                    'message' => 'E-Mail must be valid.',
                    'last' => true
                ],
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'E-Mail must be unique.'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 50],
                    'message' => 'E-Mail must be less than 50 characters.'
                ]
                'match' => [
                    'rule' => function($value, $context){
                        //return (new DefaultPasswordHasher)->check($context['data']['new_password_confirm'], $context['data']['new_password']);
                        return $context['data']['new_password_confirm'] === $context['data']['new_password'];
                    },
                    'message' => 'New Password Confirm must match New Password.'
                ]
            ])

            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'prestigeItem name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 128],
                    'message' => __('Name must be between 3 and 128 characters long.')
                ]
            ])
            ->notEmpty('description', 'An description for this role is required')
            ->notEmpty('publisher_id', 'A member is required')
            ->notEmpty('game_id', 'A role is required')
            ->notEmpty('domain_id', 'A domain is required')
*/
            ;
    }
}
?>