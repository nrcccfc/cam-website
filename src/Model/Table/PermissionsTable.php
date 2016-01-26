<?php
// src/Model/Table/PermissionsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PermissionsTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        $this->belongsTo('Roles');
        $this->belongsTo('Resources');
	}  

    public function validationDefault(Validator $validator) {

        return $validator
        /*
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Permission name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 128],
                    'message' => __('Name must be between 3 and 128 characters long.'),
                ]
            ])
           */
            ;
    }

    //Returns an array of values to initialize the database with.
    public function init() {
    	/*
            //Get the Prime domain type
            $prime_id = $this->DomainTypes->find()
                ->where(['name'=>'Prime'])
                ->first()->id
            ;
        return 
        [
            [
                    'name'              => 'White Wolf Publishing',
                    'website'           => 'www.white-wolf.com',
            ],
        ];
        */
    }
}
?>





