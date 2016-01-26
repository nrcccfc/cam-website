<?php
// src/Model/Table/PrestigeItemsDomainTypesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PrestigeItemsDomainTypesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        //$this->displayField('name');

        $this->belongsTo('PrestigeItems');
        $this->belongsTo('DomainTypes');


	}  

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('domain_type_id', 'A domain type is required')
            ->notEmpty('prestige_item_id', 'A Prestige Item is required')
            ;
    }

    public function getPrestigeItemsIds($domainTypeId){
        $results = [];
        if(!empty($roleId)){
            $items = $this->find()->where(['domain_type_id'=>$domainTypeId])->select(['prestige_item_id'])->toArray();
            foreach($items as $item){
                array_push($results, $item['prestige_item_id']);
            }
        }
        return $results;
    }



    
}
?>