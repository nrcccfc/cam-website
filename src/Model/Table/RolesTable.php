<?php
// src/Model/Table/RolesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class RolesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        $this->addBehavior('Tree');


        $this->hasMany('Children', [
            'className' => 'Roles',
            'foreignKey' => 'parent_id',
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Parent', [
            'className' => 'Roles',
        ]);
        $this->belongsTo('DomainTypes');
        $this->hasMany('Assignments', [
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);

        $this->belongsToMany('Resources', [
            'through'=>'Permissions',
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'resource_id',
        ]);

	}

    public function validationDefault2(Validator $validator) {

        return $validator
            //->requirePresence('email')
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Role name must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            ->notEmpty('abbreviation', 'An abbreviation is required')
            ->add('abbreviation', [
                'length' => [
                    'rule' => ['lengthBetween', 2, 10],
                    'message' => 'Abbreviation must be between 2 and 10 characters long.'
                ],
                /*
                'match' => [
                    'rule' => function($value, $context){
                        return stripos($value, '*') !== false;
                    },
                    'message' => 'Abbreviation must contain a "*" wildcard',
                ]
                */
            ])
            ->notEmpty('description', 'An description for this role is required')
            //->notEmpty('parent_id', 'A role is required');
            ->allowEmpty('role_limit')
            ->add('role_limit', [
                'numeric' => [
                    'rule' => 'numeric',
                    'message' => 'Role Limit must be a numeric value.'
                ],
            ])
            ->allowEmpty('parent_id')
            /*
            ->add('parent_id', [
                'notSelfParent' => [
                    'rule' => function($value, $context){
                        if(!empty($context['data']['id'])){
                            return $context['data']['id'] !== $context['data']['parent_id'];
                        } else {
                            return true;
                        }
                    },  
                    'message' => 'Role cannot have itself as a parent.'
                ],
            ])
            */
            ->notEmpty("domain_type_id")
            /*
            ->add('domain_type_id', [
                'sameAffiliate' => [
                    'rule' => function($value, $context){
                        //debug($context['data']);
                        //debug($context);
                        //debug($value);



                        if(!empty($context['data']['affiliate_id'] && !empty($context['data']['parent_id']))){
                            debug($context['data']['affiliate_id']);
                            debug($this->getParentAffiliateId($context['data']['parent_id']));
                            debug($context['data']['affiliate_id'] === $this->getParentAffiliateId($context['data']['parent_id']));
                            return (int)$context['data']['affiliate_id'] === $this->getParentAffiliateId($context['data']['parent_id']) ;
                        } else {
                            return true;
                        }
                    },  
                    'message' => 'Role cannot be of a different affiliate.'
                ],
            ])
            */
            ;
    }

    public function getAffiliateId($role_id) {
        if(is_null($role_id)){
            return null;
        } else {
            return $this->find()->where(['Roles.id'=>$role_id])->contain(['DomainTypes.Affiliates'])->first()->domain_type->affiliate_id;
        }
    }

    public function getRolesByAffiliate($affiliate_id){

        $roles = $this->find('list')
            ->contain(['DomainTypes'])
            ->join([
                'table' => 'domain_types',
                'alias' => 'dt',
                'type' => 'left',
                'conditions' => 'Roles.domain_type_id = dt.id'
                ])
            ->where(['DomainTypes.affiliate_id'=>$affiliate_id])
            ->toArray();

        return $roles;

    }



    public function buildRules(RulesChecker $rules)
    {

        //Make sure the domain_type is of the same affiliate as the parent
        $affiliateCheck = function($entity, $options) {
            if( empty($entity->parent_id) ){
                return true;
            } else {
                $parentAffiliate = $this->getAffiliateId($entity->parent_id);
                $roleAffiliate = $this->DomainTypes->getAffiliateId($entity->domain_type_id);
                return  $parentAffiliate === $roleAffiliate;
            }
        };

        $rules->add($affiliateCheck, [
            'errorField' => 'domain_type_id',
            'message' => 'The domain type you have selected does not match parent roles affiliate.'
        ]);
        return $rules;
    }

   
}
?>