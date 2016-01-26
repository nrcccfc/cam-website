<?php
// src/Model/Table/GamesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class GamesTable extends AppTable {

	public function initialize(array $config){
        parent::initialize($config);

        $this->displayField('name');

        $this->addBehavior('Tree');

        //Associations
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
	}

    public function validationDefault(Validator $validator) {

        return $validator
            //->requirePresence('email')
            ->notEmpty('name', 'An name is required')
            ->add('name', [
/*
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Game name must be unique.'
                ],
*/
                'length' => [
                    'rule' => ['lengthBetween', 3, 32],
                    'message' => 'Name must be between 3 and 32 characters long.'
                ]
            ])
            ->notEmpty('description', 'An description for this game is required')
            ->allowEmpty('allow_multiple')
            ->allowEmpty('parent_id')
            ->add('parent_id', [
                'unique' => [
                    'rule' => function($value, $context) {
                        if(!empty($context['data']['id'])){
                            return $context['data']['id'] !== $context['data']['parent_id'];

                        } else {
                            return true;
                        }

                    },
                    'message' => 'Game cannot have itself as a parent.'
                ],
            ])
            ->notEmpty('abbreviation', 'An abbriviation is required')
            ->add('abbreviation', [
                'unique' => [
                    'rule' => 'validateUnique',
                    'provider' => 'table',
                    'message' => 'Affiliate abbreviation must be unique.'
                ],
                'length' => [
                    'rule' => ['lengthBetween', 2, 10],
                    'message' => 'Abbreviation must be between 2 and 10 characters long.'
                ]
            ])
            ;
    }

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


}
?>