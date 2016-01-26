<?php
	if(!empty($records)) {
		foreach($records as $record) {
			$name = 'Error';
			if(empty($nameFormat)){
				$name = $record[$field];
			}else{
				$formatArray = array();
				foreach($nameFormat['fields'] as $fields){
					array_push($formatArray, $record[$fields['model']][$fields['field']]);
				}
				//debug($formatArray);
				$name = vsprintf($nameFormat['format'],$formatArray);
			
			}
			//debug($name);
			echo $name. '|' .$record['id'] . "\n";
		}
	} else {
		echo __('No results!')."\n";
	}
?>