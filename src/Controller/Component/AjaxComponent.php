<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class AjaxComponent extends Component {

	public $components = [];
    public $controller;


    public function initialize(array $config){
        $this->controller = $this->_registry->getController();
    }

    public function autoComplete() {
        //Decode the data
        $data = unserialize(base64_decode($this->controller->request->query['data']));
        $records = array();
        $nameFormat = $data['nameFormat'];
        $model = $data['modelName'];
        $field = $data['fieldName'];
        $contain = array();
        $fields = array('id', $field);

        //debug($data);

        //Setup the initial condition.
        //NOTE: We might need to explode the query['q'] with a '(' and then take index 0 of the results.
        //This will allow us to ignore the name formating which usually will wrap the context in ().
        $conditions = array(sprintf('%s LIKE', $field) => '%'.$this->controller->request->query['q'].'%');
        
        //Additional Conditions
        if(!empty($data['conditions'])){
            foreach($data['conditions'] as $key=>$value){
                $conditions[$key] = $value;
            }
        }
        
        //Name format
        if(!empty($nameFormat)){
            //$nameFormat = $data['name_format'];
            $nameFields = array();
            for($i=0; $i<count($nameFormat['fields']); $i++){
                list($nameModel, $nameField) = $fieldArray = explode('.', $nameFormat['fields'][$i]);
                //We are only going to support Model.field right now.
                if(!empty($nameModel) && !empty($nameField)){
                    if($nameModel == $model && $nameField == $field){
                        //Do nothing, we already are retrieving this data
                    } else {
                        if($nameModel == $model){
                            array_push($fields, $nameField);
                        } else {
                            if(!isset($contain[$nameModel])){
                                $contain[$nameModel] = array('id', $nameField);
                            } else {
                                array_push($contain[$nameModel], $nameField);
                            }
                        }
                    }
                    array_push($nameFields, array('model'=>$nameModel, 'field'=>$nameField));
                }
            }
            $nameFormat['fields'] = $nameFields;
        }

        //Load the Table
        $table = TableRegistry::get($model);
        $records = $table->find('all')
            ->where($conditions)
            ->contain($contain)
            ->select($fields)
            ->toArray()
        ;
        //debug($records);
        $this->controller->viewBuilder()->layout('ajax');
        
        $this->controller->set(compact('records', 'model', 'field', 'nameFormat'));
        $this->controller->render('/Element/auto_complete');
        
    }
}
?>