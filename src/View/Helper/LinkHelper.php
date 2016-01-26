<?php
/* src/View/Helper/LinkHelper.php */
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Inflector;
class LinkHelper extends AppHelper {

	public $helpers = ['Html'];

    public function linkArray($array, $options=array()){
    	$result = '';

    	$defaultOptions = [
    		'action' => 'view',
    		'displayField' => 'name',
    		'empty' => 'None',
    		'seperator' => ', ',
    		'sub_array' => null,
    	];

    	//Assign the options
  		$options = array_merge($defaultOptions, $options);



	  	if(count($array)){
	  		for($i=0; $i<count($array); $i++){
	  			
		  		//Get the controller name default option
		  		if (!isset($options['controller'])) {
			  		$objNameArray = explode('\\', get_class($array[$i]));
			  		$options['controller'] = Inflector::pluralize(array_pop($objNameArray));		  			
		  		}


		  		//Convert Object to Array
	  			$data = $array[$i]->toArray();

	  			//Append spacer if not the first element
	  			if($i != 0){
	  				$result .= $options['seperator'];
	  			}

	  			//Generate the link
	  			$result .= $this->Html->link($data[$options['displayField']], 
	  				[
	  					'controller'=>$options['controller'], 
	  					'action'=>$options['action'],
	  					$data['id'],
	  				]
	  			);
	  		}    		
    	} else {
    		$result = $options['empty'];
    	}

    	return $result;
    }
}

?>