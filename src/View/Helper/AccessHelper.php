<?php
/* src/View/Helper/AccessHelper.php */
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Inflector;
use App\Lib\Access;

class AccessHelper extends AppHelper {

	public $helpers = ['Html'];

/*
	public function __construct(){
		//$this->Access = new Access();
		//$this->loadComponent('Access');
		//$this->Access = new AccessComponent();
	}
*/

	public function alink($access, $title, $url = null, array $options = array()) {
		$this->Access = new Access();

		//Update Controller
		if(!empty($url['controller'])){
			$access['controller'] = $url['controller'];
		}

		//Update Action
		if(!empty($url['action'])){
			$access['action'] = $url['action'];
		}

		//Update Id
		if(!empty($url[0])){
			$access['id'] = $url[0];
		}

		$link = $title;
		if($this->Access->check($access) ) {
			$link =  $this->Html->link($title, $url, $options);
		}else{
			//debug($access);
		}
		
		return $link;
	}

}

?>