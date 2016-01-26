<?php
// src/Model/Table/PublishersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PublishersTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //$this->hasMany('Domains');
        //$this->hasMany('DomainTypes');
        //$this->hasMany('Roles');
	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Publisher name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 128],
                    'message' => __('Name must be between 3 and 128 characters long.'),
                ]
            ])
            ;
    }

    //Returns an array of values to initialize the database with.
    public function init() {
        return 
        [
            [
                    'name'              => 'White Wolf Publishing',
                    'website'           => 'www.white-wolf.com',
            ],
        ];
    }
}
?>