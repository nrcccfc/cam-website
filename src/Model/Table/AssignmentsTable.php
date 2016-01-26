<?php
// src/Model/Table/AssignmentsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class AssignmentsTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);
        
        $this->belongsTo('Members');
        $this->belongsTo('Roles');
        $this->belongsTo('Domains');
        $this->belongsTo('Venues');
	}

    public function validationDefault(Validator $validator) {

        return $validator
            ->requirePresence('role_id')
            /*
            ->add('role_id', [
                'maxAssignments' => [
                    'rule' => [$this, 'hasMaxAssignments'],
                    'message' => 'The role you have selected has reached its maximum assignments.'
                ],                
            ])
            */
            ->requirePresence('venue_id')
            ->allowEmpty('venue_id') 
            

            ->add('venue_id', [
                'validVenue' => [
                    'rule' => [$this, 'isValidVenue'],
                    'message' => 'The role you have selected must have a venue assigned to it.'
                ],
                'properVenue' => [
                    'rule' => [$this, 'isProperVenue'],
                    'message' => 'The role you have selected cannot have a venue assigned to it.'
                ],
            ])
            ->notEmpty('member_id', 'A member is required')
            ->notEmpty('role_id', 'A role is required')
            ->notEmpty('domain_id', 'A domain is required')
            ;
    }

/*
    public function hasMaxAssignments($value, $context){
            //Get the Current Role.
            $currentRole = $this->Roles
                ->find()
                ->where(['id'=>$context['data']['role_id']])
                ->contain(['Assignments'=>['fields'=>['id', 'role_id']]])
                ->select(['id', 'allow_multiple'])
                ->first()
                ->toArray()
                ;

            //If we do not allow multiple records and currently have some.
            //debug($context['data']);
            //debug($currentRole['assignments']);
            if(!$currentRole['allow_multiple'] && $currentRole['assignments'][0]['id'] != $context['data']['id'] && count($currentRole['assignments'])){
                return false;
            }
            return true;
    }
*/


    //Check to see if the assignments that need venues have them and those that dont, do not.
    public function isValidVenue($value, $context){
            //Get the Current Role.
            $currentRole = $this->Roles
                ->find()
                ->where(['id'=>$context['data']['role_id']])
                //->contain('Assignments')
                ->first()
                ->toArray()
                ;

            if($currentRole['is_venue_specific'] && empty($value) ){
                return false;
            }
            return true;
    }

    public function isProperVenue($value, $context){
            //Get the Current Role.
            $currentRole = $this->Roles
                ->find()
                ->where(['id'=>$context['data']['role_id']])
                ->first()
                ->toArray()
                ;

            if(!$currentRole['is_venue_specific'] && !empty($value) ){
                return false;
            }
            return true;
    }

    public function generateName($assignment){
            //Check the venue to see if there are any listed.
            $letter = $assignment->domain->domain_type->abbreviation; //For Domain
            $venueName = '';
            if(!empty($assignment->venue)){
                if(empty($assignment->domain->children)){
                    $letter = 'V';
                }
                $venueName = ':'.$assignment->venue->name;
            }
            $roleName = str_replace('*', $letter, $assignment->role->abbreviation);
            return $assignment->domain->name.':'.$roleName.$venueName;
    }





    //Check to see if a venue was selected even though the role might not be venue specific

    //Check to see if role has already been assigned to another person. IF so, assign the role to this new user. Maybe give a warning...

    //Make sure assignment is not a duplicate.

    //Make sure the domain that is assigned is of the same affiliate as the role.

    public function buildRules(RulesChecker $rules)
    {

        $hasMaxAssignmentsCheck = function($entity, $options){
            //If we do not allow multiple records and currently have some.
            //debug($entity);

            $currentRole = $this->Roles
                ->find()
                ->where(['id'=>$entity->role_id])
                ->contain(['Assignments'])
                ->first()
                //->select(['id', 'limit'])
                ;
            if ($currentRole->role_limit === 0){
                //If Role_limit is 0 which means its not limited, then return true.
                return true;
            }

            //Get all the assignements that match the current entity.
            $conditions = ['Assignments.role_id'=>$entity->role_id, 'Assignments.domain_id'=>$entity->domain_id, 'Assignments.venue_id'=>$entity->venue_id];
            if(is_null($entity->venue_id)){
                $conditions = ['Assignments.role_id'=>$entity->role_id, 'Assignments.domain_id'=>$entity->domain_id, 'Assignments.venue_id IS NULL'];
            }

            $assignments = $this->find('all')
                ->where($conditions)
                ->contain(['Domains.DomainTypes']);

            
            return $currentRole->role_limit > $assignments->count();
        };

        $affiliateCheck = function($entity, $options) {
            $roleAffiliate = $this->Roles->getAffiliateId($entity->role_id);
            $domainAffiliate = $this->Domains->getAffiliateId($entity->domain_id);
            return  $roleAffiliate === $domainAffiliate;
        };


        
        $rules->add($hasMaxAssignmentsCheck, [
            'errorField' => 'role_id',
            'message' => 'The role you selected has already reached its limit.'
        ]);
        $rules->add($affiliateCheck, [
            'errorField' => 'domain_id',
            'message' => 'The domain you selected belongs to a different affiliate than the selected role.'
        ]);
        //debug($rules);
        return $rules;
    }

}
?>