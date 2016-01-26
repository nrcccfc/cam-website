<?php
// src/Model/Table/prestigeCategoriesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class prestigeCategoriesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //Associations
        $this->belongsTo('Affiliates');
        $this->hasMany('PrestigeCategories');
	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('name', 'A name is required')
            ->add('name', [
                'length' => [
                    'rule' => ['lengthBetween', 3, 50],
                    'message' => __('Name must be between 3 and 50 characters long.')
                ]
            ])
            ->notEmpty('affiliate_id', 'An Affiliate is required')
            ->notEmpty('monthly_limit', 'A monthly limit is required')
            ->add('monthly_limit', [
                'numeric' => [
                    'rule' => 'numeric',
                    'message' => __('Monthly Limit must be a numerical value.')
                ],
                'range' => [
                    'rule' => ['range', 1, 1000],
                    'message' => __('Monthly Limit must be greater than 0.')
                ],
            ])
            ;
    }
}
?>