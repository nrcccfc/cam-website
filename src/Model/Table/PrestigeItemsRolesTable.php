<?php
// src/Model/Table/PrestigeItemsRolesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PrestigeItemsRolesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        //$this->displayField('name');

        $this->belongsTo('PrestigeItems');
        $this->belongsTo('Roles');


	}  

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('role_id', 'A Role is required')
            ->notEmpty('prestige_item_id', 'A Prestige Item is required')
            ;
    }

    public function getPrestigeItemsIds($roleId){
        $results = [];
        if(!empty($roleId)){
            $items = $this->find()->where(['role_id'=>$roleId])->select(['prestige_item_id'])->toArray();
            foreach($items as $item){
                array_push($results, $item['prestige_item_id']);
            }
        }
        return $results;
    }



    
}
?>





