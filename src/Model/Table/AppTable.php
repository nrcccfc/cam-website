<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AppTable extends Table {
    public function initialize(array $config) {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
    }

    //This is used to initialize the database tables
    public function initializeDb($init = null){
        if(!empty($init) && $this->find()->count() === 0){
        	$results = array();
        	foreach($init as $data){
	             $entity = $this->newEntity($data);
	             //debug($entity);
	            if($result = $this->save($entity, ['validate'=>false])){
	            	array_push($results, $result);
	            }
        	}
        	return $results;
        }
        return null;
    }

    //This is used to get the record owners id to for security reasons
    public function getOwnerId($record_id){
        return null;
    }
}
?>