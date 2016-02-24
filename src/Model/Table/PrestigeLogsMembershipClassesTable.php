<?php
// src/Model/Table/PrestigeLogsMembershipClassesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;


class PrestigeLogsMembershipClassesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        //$this->displayField('name');

        $this->belongsTo('PrestigeLogs');
        $this->belongsTo('MembershipClasses');
        $this->belongsTo('Officers', [
            'className' => 'Members',
            'foreignKey' => 'officer_id',
            //'dependant' => true,
            //'cascadeCallbacks' => true,
        ]);
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


  /*  
    public function buildRules(RulesChecker $rules)
    {

        //This needs to make sure that the domain that is being assigned to the item is of a valid domain type.
        //This means that national level prestige items can only be assigned national level domains. 
        //Regional level prestige can only be assigned to regional domains (if they exist...)
        //General prestige items can only be assigned to local domains.


        //This also should try to be smart about what kind of prestige it assigns. If an item can be either "G" or "R",
        //Pick the highest depending on the domain type. 

        //Make sure the prestige_item is of the same affiliate as the role.
        $domainTypeCheck = function($entity, $options) {

            //Get the prestige item we are testing.
            $prestigeItem = $this->PrestigeItems->find()->where(['id'=>$entity->prestige_item_id])->contain(['DomainTypes'])->first();

            //Get the items domain type.
            $domain = $this->Domains->find()->where(['domains.id'=>$entity->domain_id])->select(['domain_type_id'])->first();

            //Check the prestige items domain types to see if the currently selected domain's domain_type is in it.
            foreach($prestigeItem->domain_types as $domainType){
                if ($domainType->id === $domain->domain_type_id){
                    return true;
                }
            }
            return false;
        };
*/

/*
        $domainAffiliateCheck = function($entity, $options) {
            //debug($entity);
            $affiliateId = $this->Domains->getAffiliateId($entity->domain_id);

            //=>function($q){return $q->select(['id', 'monthly_limit', 'name']);}

            //Get the prestige item we are testing.
            $prestigeItem = $this->PrestigeItems->find()->where(['id'=>$entity->prestige_item_id])->first();
            //debug($prestigeItem);

            //Get the items domain type.
            $domain = $this->Domains->find()->where(['domains.id'=>$entity->domain_id])->select(['domain_type_id'])->first();


            if ($affiliateId === $prestigeItem->affiliate_id){
                return true;
            }
            return false;
        };

        
        //Make sure there is atleast one role selected

        //Make sure there is atleast one prestige type selected.


        $rules->add($domainTypeCheck, [
            'errorField' => 'domains',
            'message' => 'You have not selected a domain of a valid type for that item.'
        ]);

        //I am not sure this is needed since DomainTypes are already owned by the Affilaite. The DomainTypeCheck should already fail if another affiliates domain is selected.
        //$rules->add($domainAffiliateCheck, [
        //    'errorField' => 'domains',
        //    'message' => 'You have not selected a domain from a different affiliate.'
        //]);

        

        return $rules;
    }
*/    





    //Get a list of the game names, grouped by parent game names
    public function getPrestigeItemsStatusList() {
        return ['Pending', 'Denied', 'Approved'];
    }

    public function getPrestigeItemsToBeApproved($assignments) {
        //debug($assignments);

        $prestigeLogsItems = [];
        foreach($assignments as $assignment){
            $items = $this->getPrestigeItemsToBeApprovedByAssignment($assignment['name'], $assignment['domain_id'], $assignment['role_id'], $assignment['venue_id']);

            foreach($items as $item){
                if(isset($prestigeLogsItems[$item->id])){
                    //Append AssignmentName
                    array_push($prestigeLogsItems[$item->id]->assignment_name,  $item->assignment_name[0]);
                }else{
                    //New Item
                    $prestigeLogsItems[$item->id] = $item;

                    //array_push($prestigeLogsItems, $item);
                }
                
            }
            //$prestigeLogsItems = array_merge($prestigeLogItems, $items);
            
        }
        //debug($prestigeLogItems);
        //debug($prestigeLogsItems);
        return $prestigeLogsItems;
    }

    public function getPrestigeItemsToBeApprovedByAssignment($assignment_name, $domain_id, $role_id, $venue_id=null){
        $conditions = ['status'=>0]; //Unapproved

        //Get all the domainIds this assignment can approve for
        $domainIds = $this->Domains->getChildrenIds($domain_id, true);
        $conditions['PrestigeLogsItems.domain_id IN'] = $domainIds;
        //debug($domainIds);

        //Get the PrestigeItems this Assignment can approve for.
        $prestigeItemIds = $this->PrestigeItems->PrestigeItemsRoles->getPrestigeItemsIds($role_id);
        $conditions['PrestigeLogsItems.prestige_item_id IN'] = $prestigeItemIds;
        //debug($prestigeItemIds);

        //Get the Venue this Assignment can approve for if the role is venue specific
        if (!is_null($venue_id)){
            $conditions['PrestigeLogsItems.venue_id'] = $venue_id;
        }

        //Get all the prestige items that are unapproved.
        $prestigeItems = $this->find()
            //->group(['PrestigeLogsItems.id', 'Games.id'])
            ->contain(['PrestigeItems', 'Domains', 'Venues.Games', 'PrestigeLogs.Members'=>function($q){return $q->select(['id', 'first_name', 'last_name', 'username']); }]) //We only load the id/name of the member for security reasons.
            ->where($conditions)
            //->toArray()
            ;
        //debug($prestigeItems);

        //debug($conditions);
        //debug($items);

        $results = [];
        foreach($prestigeItems as $prestigeItem) {
            $isSecondary = 1;
            if ($prestigeItem['domain_id'] === $domain_id){
                $isSecondary = 0;
            }
            $prestigeItem['assignment_name'] = [[$role_id=>$assignment_name]];
            $prestigeItem['primary'] = !$isSecondary;
            array_push($results, $prestigeItem);
        }
        //debug($results);
        return $results;
    }

    public function getApprovalList(){
        return ['1'=>'Deny', '2'=>'Approve'];
    }




}
?>





