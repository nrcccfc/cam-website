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

    public function calculateMembershipClass($general_prestige, $regional_prestige, $national_prestige){
        return "MC 9001";
    }

}
?>