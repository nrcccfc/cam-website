<?php
// src/Model/Table/prestigeItemsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class PrestigeItemsTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //Associations
        $this->belongsTo('PrestigeCategories');
        $this->belongsTo('Affiliates');
        /*
        $this->belongsToMany('PrestigeTypes', [
            'through'=>'PrestigeItemsTypes',
            'foreignKey' => 'prestige_item_id',
            'targetForeignKey' => 'prestige_type_id',
        ]);
    */
        $this->belongsToMany('DomainTypes', [
            'through'=>'prestige_items_domain_types',
            'foreignKey' => 'prestige_item_id',
            'targetForeignKey' => 'domain_type_id',
        ]);
        $this->belongsToMany('Roles', [
            'through'=>'PrestigeItemsRoles',
            'join_table'=>'prestige_items_roles',
            'foreignKey' => 'prestige_item_id',
            'targetForeignKey' => 'role_id',
        ]);
        $this->hasMany('PrestigeLogsItems', [
            'dependant' => true,
            'cascadeCallbacks' => true,
            'foreignKey' => 'prestige_item_id',
        ]);
        $this->hasMany('PrestigeItemsRoles', [
            'dependant' => true,
            'cascadeCallbacks' => true,
            'foreignKey' => 'prestige_log_id',
        ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->notEmpty('role_id', 'An Role is required')
            ->notEmpty('prestige_category_id', 'A Prestige Category is required')
            ->notEmpty('description', 'A Description is required')
            ->notEmpty('name', 'A Name is required')
            ;
    }

    public function getRolesList($affiliateIds=null) {

        if(!is_null($affiliateIds) && !is_array($affiliateIds)){
            $affiliateIds = array($affiliateIds);
        }


        $roles = null;
        if($affiliateIds){

            $roles = $this->Roles
                ->find('all')
                ->contain(['DomainTypes.Affiliates'])
                ->join([
                    'table' => 'domain_types',
                    'alias' => 'dt',
                    'type' => 'left',
                    'conditions' => 'roles.domain_type_id = dt.id'
                    ])
                ->where(['DomainTypes.affiliate_id IN'=>$affiliateIds])
                ->toArray()
                ;

        } else{
            $roles = $this->Roles
                ->find('all')
                ->contain(['DomainTypes.Affiliates'])
                ->toArray()
                ;
        }

        $results = [];
        //debug($affiliateId);
        //debug($roles);
        foreach($roles as $role) {
            $categoryName = "Not Affiliated";
            if (!is_null($role['domain_type']['affiliate_id'])){
                $categoryName = $role['domain_type']['affiliate']['name'];
            }
            
            $itemName = $role->name . ": (" . $categoryName. ")";

            //if (empty($results[$categoryName])){
            //    $results[$categoryName] = [];
            //}
            $results[$role->id] = $itemName;

        }

        return $results;

    }


    //Get a list of the game names, grouped by parent game names
    public function getPrestigeItemsList($affiliateId) {
        $prestigeItems = $this->find('threaded')
            ->contain('PrestigeCategories')
            ->where(['PrestigeItems.affiliate_id' => $affiliateId])
            ->toArray();
        $result = [];
        //debug($prestigeItems);
        foreach($prestigeItems as $prestigeItem){
            $categoryArray = [];
            $categoryName = $prestigeItem->prestige_category->name . ":  Monthly Limit(" . $prestigeItem->prestige_category->monthly_limit . ")";
            $itemName = $prestigeItem->name . ": (" . $prestigeItem->value_min . "-". $prestigeItem->value_max . ", Monthly Limit: ".$prestigeItem->monthly_limit. ")";
            //debug($categoryName);
            //debug($itemName);

            if( empty($result[$categoryName]) ) {
                $result[$categoryName] = [];
            }

            $result[$categoryName][$prestigeItem->id] = $itemName;
        }
        return $result;
    }

    public function getAffiliateId($domainId){
        if(!empty($domainId)){
            return $this->Domain->DomainTypes->getAffiliateId($this->getDomainType($domainId)->id);
        }
        return null;
    }


    public function buildRules(RulesChecker $rules)
    {

        //Make sure the prestige_item is of the same affiliate as the role.
        $affiliateCheck = function($entity, $options) {
            //debug($entity);
            

            $valid = true;
            foreach ($entity->roles as $role){
                //debug($role);
                $roleAffiliateId = $this->Roles->getAffiliateId($role->role_id);
                //debug($entity->affiliate_id);
                //debug($roleAffiliateId);
                if ($entity->affiliate_id and !is_null($roleAffiliateId) and $entity->affiliate_id !== $roleAffiliateId){
                    $valid = false;
                    break;
                }
            }
            //debug($valid);
            return  $valid;
        };

        //Make sure there is atleast one role selected

        //Make sure there is atleast one prestige type selected.


        $rules->add($affiliateCheck, [
            'errorField' => 'roles',
            'message' => 'One of the roles you have selected does not match your affiliate.'
        ]);
        return $rules;
    }



}
?>