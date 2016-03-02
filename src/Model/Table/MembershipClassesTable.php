<?php
// src/Model/Table/MembershipClassesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class MembershipClassesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        //$this->addBehavior('Tree');



        //Associations
        $this->belongsTo('Affiliates');
        $this->belongsToMany('Roles', [
            'through'=>'MembershipClassesRoles',
            'join_table'=>'membership_classes_roles',
            'foreignKey' => 'membership_class_id',
            'targetForeignKey' => 'role_id',
        ]);
        $this->hasMany('PrestigeLogsMembershipClasses', [
            'dependant' => true,
            'cascadeCallbacks' => true,
            'foreignKey' => 'membership_class_id',
        ]);
/*
        $this->hasMany('Children', [
            'className' => 'Games',
            'foreignKey' => 'parent_id',
            'dependant' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->belongsTo('Parent', [
            'className' => 'Games',
        ]);

        $this->hasMany('Books');
        $this->belongsToMany('Continuities',
            [
                //'saveStrategy' => 'append',
                'targetForeignKey' => 'continuity_id',
                'foreignKey' => 'game_id',
                'joinTable' => 'continuities_games',
            ]);
*/
	}


    public function validationDefault(Validator $validator) {


        return $validator
            //->requirePresence('email')
            ->notEmpty('level', 'An level is required')
            ->notEmpty('name', 'An name is required')
            ->add('name', [
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            //->notEmpty('general', 'General Prestige Requirement is required')
            //->notEmpty('regional', 'Regional Prestige Requirement is required')
            //->notEmpty('national', 'National Prestige Requirement is required')
            ->allowEmpty('general_prestige')
            ->allowEmpty('regional_prestige')
            ->allowEmpty('national_prestige')
            ->allowEmpty('affiliate_id')
            ;
    }

/*
    //Get a list of the names with the affiliaite abbreviation in it.
    public function getPublishersList($games) {
        $results = array();
        //debug($entities);
        foreach($games as $game){
            foreach( $game->books as $book ) {
                //debug($child->affiliate->abbreviation);
                $results[$book->publisher->id] = $book->publisher->name;
            }
        }
        return $results;
    }


    //Get a list of the game names, grouped by parent game names
    public function getGamesList() {
        $games = $this->find('threaded')->toArray();
        $result = [];
        foreach($games as $game){
            if(empty($game->children)){
                $result[$game->id] = $game->name;
            } else {
                $childArray = [];
                foreach($game->children as $child){
                    $childArray[$child->id] = $child->name;
                }
                $result[$game->name] = $childArray;
            }
        }
        return $result;
    }
*/

    public function calculateMembershipClass($prestigeLog, $prestigeTotal){
        //Get the members current MC

        $results = ['currentLevel'=>0, 'nextLevel'=>1, 'currentReqs'=>[], 'nextReqs'=>[]];
        $affiliateId = $prestigeLog->member->domain->domain_type->affiliate_id;
        $general_prestige = $prestigeTotal['Total'][0] + $prestigeTotal['Total'][1] + $prestigeTotal['Total'][2];
        $regional_prestige = $prestigeTotal['Total'][1] + $prestigeTotal['Total'][2];
        $national_prestige = $prestigeTotal['Total'][2];

        //Get the membershipClasses that have already been added to the Prestige Log
        $currentMembershipClasses = $prestigeLog->prestige_logs_membership_classes;


        //Get all the membershipClasses for the affiliate
        $membershipClasses = $this->find('all')->where(['MembershipClasses.affiliate_id'=>$affiliateId])->order('MembershipClasses.level')->toArray();

        for($i=0; $i<count($membershipClasses); $i++){
            $j = $i + 1;
            if($general_prestige >= $membershipClasses[$i]['general_prestige'] && $regional_prestige >= $membershipClasses[$i]['regional_prestige'] && $national_prestige >= $membershipClasses[$i]['national_prestige']){

                $approved = False;
                if(empty($currentMembershipClasses[$i] )){
                    $prestigeLogMembershipClass = ['prestige_log_id'=>$prestigeLog['id'], 'membership_class_id'=>$membershipClasses[$i]['id']];
                    //debug($this->PrestigeLogsMembershipClasses);
                    $newPrestigeLogsMembershipClass = $this->PrestigeLogsMembershipClasses->newEntity($prestigeLogMembershipClass);
                    //debug($newPrestigeLogsMembershipClass);
                    $this->PrestigeLogsMembershipClasses->save($newPrestigeLogsMembershipClass);
                    //debug('Need to added '.$i);

                } else {
                    $approved = True;
                }

                $results['currentLevel'] = $membershipClasses[$i]['level'];
                $results['currentReqs'][0] = $membershipClasses[$i]['general_prestige'];
                $results['currentReqs'][1] = $membershipClasses[$i]['regional_prestige'];
                $results['currentReqs'][2] = $membershipClasses[$i]['national_prestige'];

                if ($approved){
                    $results['approvedLevel'] = $membershipClasses[$i]['level'];                    
                }

                if ($i < count($membershipClasses)) {
                    $results['nextLevel'] = $membershipClasses[$j]['level'];
                    $results['nextReqs'][0] = $membershipClasses[$j]['general_prestige'];
                    $results['nextReqs'][1] = $membershipClasses[$j]['regional_prestige'];
                    $results['nextReqs'][2] = $membershipClasses[$j]['national_prestige'];
                } else {
                    $results['nextLevel'] = -1;
                    $results['nextReqs'][0] = -1;
                    $results['nextReqs'][1] = -1;
                    $results['nextReqs'][2] = -1;
                }
                

            }
        }

        //debug($prestigeLog);
        //debug($prestigeTotal);
        //debug($membershipClasses);
        //debug($currentLevel);
        return $results;
    }

}
?>