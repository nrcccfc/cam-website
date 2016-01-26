<?php
// src/Model/Table/DomainTypesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class DomainTypesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Tree');

        //Associations
        $this->hasMany('Children', [
            'className' => 'DomainTypes',
            'foreignKey' => 'parent_id',
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Parent', [
            'className' => 'DomainTypes',
        ]);
        $this->belongsTo('Affiliates');
        $this->hasMany('Domains', [
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
            //->requirePresence('email')
            //->notEmpty('name', 'An name is required')
            ->add('name', [
                'uniqueToAffiliate' => [
                    'rule' => function($value, $context){
                        if(isset($context['data']['is_unique'])){
                            return $context['data']['is_unique'] === true;
                        }
                        return true;
                    },
                    'message' => 'DomainType name must be unique within it affiliate.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            //->notEmpty('parent_id', 'A role is required');
            ->allowEmpty('allow_members')
            ->add('allow_members', [
                'boolean' => [
                    'rule' => 'boolean',
                    'message' => 'Allow Members must be a boolean.'
                ],
            ])
            ->notEmpty('affiliate_id', 'An affiliate is required')
            ->add('affiliate_id', [
                'matchesParent' => [
                    'rule' => function($value, $context){
                        if(!empty($context['data']['parent_affiliate_id'])){
                            return $value === $context['data']['parent_affiliate_id'];
                        }
                        return true;
                    },
                    'message' => 'Affiliate must match parent\'s Affiliate.'
                ],
            ])
            ->allowEmpty('parent_id')
            ->add('parent_id', [
                'unique' => [
                    'rule' => function($value, $context){
                        if(!empty($context['data']['id'])){
                            return $context['data']['id'] !== $context['data']['parent_id'];
                        }
                        return true;
                        
                    },
                    'message' => 'DomainType cannot have itself as a parent.'
                ],
            ]);
    }


    //Get a list of the names with the affiliaite abbreviation in it.
    public function getContextNameList($domainTypeId=null, $affiliate_ids=null) {
        $entities = $this->find()
            ->contain('Affiliates')
            ->toArray();

        if(!is_null($affiliate_ids) && !is_array($affiliate_ids)){
            $affiliate_ids = array($affiliate_ids);
        }


        $results = array();
        foreach($entities as $entity){
            if($entity->id !== $domainTypeId){
                if($affiliate_ids){
                    if(!empty($entity->affiliate) && in_array($entity->affiliate->id, $affiliate_ids) ){
                        $results[$entity->id] = $entity->name.' ('.$entity->affiliate->abbreviation.')';
                    }
                }else{
                     if(!empty($entity->affiliate)){
                        $results[$entity->id] = $entity->name.' ('.$entity->affiliate->abbreviation.')';
                    } else {
                        $results[$entity->id] = $entity->name;
                    }                   
                }          
            }            
        }
        return $results;
    }


    public function isNameUniqueInAffiliate($originalName, $newName, $affiliate_id){
            //Make sure the name is unique within the affiliate
            if($originalName !== $newName){
                return $this
                    ->find()
                    ->where(['name'=>$newName, 'affiliate_id'=>$affiliate_id])
                    ->count()>0?false:true;
            }
            return true;
    }

    public function getParentAffiliate($parentId){
        if(!empty($parentId)){
            return $this->find()
                ->where(['DomainTypes.id' => $parentId])
                ->contain(['Affiliates'])
                ->first()
                ->affiliate
            ;
        }
        return null;
    }

      public function getAffiliate($domainTypeId){
        if(!empty($domainTypeId)){
            return $this->find()
                ->where(['DomainTypes.id' => $domainTypeId])
                ->contain(['Affiliates'])
                ->first()
                ->affiliate
            ;
        }
        return null;
    }  

    public function getAffiliateId($domainTypeId){
        $affiliate = $this->getAffiliate($domainTypeId);
        if(!empty($affiliate)){

            return $affiliate->id;
        }
        return null;
    }


    public function getParentAffiliateId($parentId){
        $parentAffiliate = $this->getParentAffiliate($parentId);

        if(!empty($parentAffiliate)){

            return $parentAffiliate->id;
        }
        return null;
    }

    //Returns an array of values to initialize the database with.
    public function init() {
        return 
        [
            [
                    'parent_id'         => null,
                    'affiliate_id'      => null,
                    'name'              => 'Prime',
                    'allow_members'     => false,
            ],
        ];
    }


}
?>