<?php
// src/Model/Table/DomainsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class DomainsTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');
        $this->addBehavior('Tree');

        //Associations
        $this->hasMany('Children', [
            'className' => 'Domains',
            'foreignKey' => 'parent_id',
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Parent', [
            'className' => 'Domains',
        ]);
        $this->belongsTo('Affiliates');
        $this->belongsTo('DomainTypes');
        $this->belongsTo('Assignments');
        $this->hasMany('Members', [
            'className' => 'Members',
            'foreignKey' => 'domain_id',
        ]);
        $this->hasMany('Announcements', [
            'className' => 'Announcements',
            'foreignKey' => 'domain_id',
        ]);
	}

    public function validationDefault(Validator $validator) {

        return $validator
            //->requirePresence('email')
            //->notEmpty('name', 'An name is required')
            ->add('name', [
                'uniqueToContext' => [
                    'rule' => function($value, $context){
                        if(!empty($context['data']['is_unique'])){
                            return $context['data']['is_unique'] === true;
                        }
                        return true;
                    },
                    'message' => 'Domain name must be unique within its context.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 2, 32],
                    'message' => 'Name must be between 2 and 32 characters long.'
                ]
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
                    'message' => 'Domain cannot have itself as a parent.'
                ],
            ])
            ;
    }


    //Get a list of the names with the affiliaite abbreviation in it.
    public function getContextNameList($parentId) {
        $entities = $this->find()
            ->contain(['DomainTypes.Children'=>['Affiliates']])
            ->where(['Domains.id' => $parentId])
            ->toArray()
            ;
        $results = array();
        //debug($entities);
        foreach($entities as $entity){
            $children = $entity->domain_type->children;
            foreach( $children as $child ) {
                //debug($child->affiliate->abbreviation);
                $results[$child->id] = $child->name.' ('.$child->affiliate->abbreviation.')';
            }
            
            //$results[$entity->id] = $entity->name.' ('.$entity->affiliate->abbreviation.')';
        }
        return $results;
    }

    //Get a list of the names with the affiliaite abbreviation in it.
    public function getContextNameListByAffiliate($affiliateId){
        $entities = $this->find()
            ->contain('DomainTypes.Affiliates')
            ->join([
                'table' => 'domain_types',
                'alias' => 'dt',
                'type' => 'inner',
                'conditions' => 'domains.domain_type_id = dt.id'
                ])
            ->where(['DomainTypes.affiliate_id'=>$affiliateId])
            ->toArray();
        $results = array();

        //debug($entities);
        foreach($entities as $entity){
            if(isset($entity->domain_type->affiliate_id)){
                $results[$entity->id] = $entity->name.' ('.$entity->domain_type->affiliate->abbreviation.')';
            } else {
                $results[$entity->id] = $entity->name;
            }
            
        }
        //debug($results);
        return $results;        
    }


    public function isNameUniqueInAffiliate($originalName, $newName, $affiliate_id){
            //Make sure the name is unique within the affiliate
            if($originalName !== $newName){
                return $this
                    ->find()
                    ->where(['name'=>$newName, 'affiliate_id'=>$affiliate_id])
                    ->count()>1?false:true;
            }
            return true;
    }

    public function getChildrenIds($domainId, $includeSelf=false){
        $results = [];
        if ($includeSelf){
            array_push($results, $domainId);
        }
        $children = $this->find('children', ['for' =>$domainId])->select(['id'])->toList();
        foreach($children as $child){
            array_push($results, $child['id']);
        }
        return $results;
    }

    public function getParentDomainType($parentId){
        if(!empty($parentId)){
            return $this->find()
                ->where(['Domains.id' => $parentId])
                ->contain(['DomainTypes'])
                ->first()
                ->domain_type
            ;
        }
        return null;
    }

    public function getParentDomainTypeId($parentId){
        if(!empty($parentId)){
            return $this->getParentDomainType($parentId)->id;
        }
        return null;
    }

    public function getDomainType($domainId){
        if(!empty($domainId)){
            return $this->find()
                ->where(['Domains.id' => $domainId])
                ->contain(['DomainTypes'])
                ->first()
                ->domain_type
            ;
        }
        return null;
    }

    public function getDomainTypeId($domainId){
        if(!empty($domainId)){
            return $this->getDomainType($domainId)->id;
        }
        return null;
    }

    public function getAffiliateId($domainId){
        if(!empty($domainId)){
            return $this->DomainTypes->getAffiliateId($this->getDomainType($domainId)->id);
        }
        return null;
    }


    public function getColorsList(){
        return [
            ''          => __('Use Custom Color'),
            '#FF0000'   => __('Red'),
            '#880000'   => __('Brick'),
            '#FF8800'   => __('Orange'),
            '#FFFF00'   => __('Yellow'),
            '#88FF00'   => __('Lime'),
            '#00FF00'   => __('Green'),
            '#00FF88'   => __('Teal'),
            '#00FFFF'   => __('Cyan'),
            '#0000FF'   => __('Blue'),
            '#000088'   => __('Navy'),
            '#8800FF'   => __('Indigo'),
            '#FF00FF'   => __('Magenta'),
            '#FF0088'   => __('Fushia'),
            '#440088'   => __('Purple'),
            '#885500'   => __('Brown'),
        ];
    }


    //Returns an array of values to initialize the database with.
    public function init() {
            //Get the Prime domain type
            $prime_id = $this->DomainTypes->find()
                ->where(['name'=>'Prime'])
                ->first()->id
            ;
        return 
        [
            [
                    'parent_id'         => null,
                    'domain_type_id'    => $prime_id,
                    'name'              => 'Prime',
                    'description'       => 'This is the prime domain. All national domains will have this domain as a DomainType.',
                    'colors'            => '#FFCCAA',
            ],
        ];
    }

}
?>