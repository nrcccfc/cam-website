<?php 
namespace App\Controller\Component;

use Cake\Controller\Component;
/** 
 * prgPattern - cakePHP component for applying the Post/Redirect/Get design pattern 
 * the vars will be accesibile after applying redirect() in $this->params['named'] 
 * 
 * @author Michael Gaiser (mjgaiser@gmail.com)
 * @author Lucian SABO (luci@criosweb.ro)
 * @CakeVersion 3.0b1
 */ 

class prgPatternComponent extends Component { 
    public $controller; 
    private $_encodedData;
    private $_dataName = 'data';

    //called before Controller::beforeFilter() 
    function initialize(array $config) {
        //parent::initialize();
    	//Saving the controller reference for later use 
        //$this->controller =& $controller;
        $this->controller = $this->_registry->getController();

        //debug($this->controller->request);
        //debug($this->;
    } 
     
    //called after Controller::beforeFilter()
    function startup(&$controller) {
    } 
     
    //called after Controller::beforeRender() 
    function beforeRender(&$controller) { 
    } 
     
    //called after Controller::render() 
    function shutdown(&$controller) { 
    } 
     
    //called before Controller::redirect() 
    function beforeRedirect(&$controller, $url, $status = null, $exit = true) { 
    } 
     
    function encodeData($data, $section) {
		$this->_encodedData[$section] = base64_encode(serialize($data));                            
		return (isset($this->_encodedData[$section]) && !empty($this->_encodedData[$section])); 
    } 
     
    function decodeSectionData($section, $data) {
    	return unserialize(base64_decode($data));
    }
     
    /** 
     * Following the Post/Redirect/Get design pattern, we take all POST parameters 
     * and send them by GET to the specified URL 
     *  
     * @param array $url cakePHP url to redirect the request 
     */
    public function redirect($url = array()) {

        //debug($this->controller->request);

     
        // Use Post/Redirect/Get design pattern to make the code compatible with pagination parameters
        if ($this->controller->request->is('post') && !empty($this->controller->request->data)) { 
                
            //debug($this->controller->request->data);

        	// loop through POST parameters, encode them 
        	$this->encodeData($this->controller->request->data, $this->_dataName); 
         
        	// add the params to the URL
        	//debug($this->controller->request->params);
        	if(empty($url)){
        		$url = array('controller'=>$this->controller->request->params['controller'], 'action'=>$this->controller->request->params['action']);
        		
        		//Encode the passed args
        		foreach($this->controller->request->pass as $k=>$v){
        			$url[$k] = $v;
        		}
        		
        		//Encode the named args
        		foreach($this->controller->request->query as $k=>$v){
        			$url[$k] = $v;
        		}
        	}
        	$url = array_merge($url, $this->_encodedData);

            //debug($url);

        	// Do the (magical) redirect 
        	// Proper compliance for HTTP 1.1 spec requires that applications provide a HTTP 303 response 
        	// in this situation to ensure that the web user's browser can then safely refresh the server 
        	// response without causing the initial HTTP POST request to be resubmitted. 
        	$this->controller->redirect($url, 303);
        }
    }
     
	function decode() {
		// decode the params 
		//debug($this->controller->request->params);
		if (!empty($this->controller->request->query)) {

			if (isset($this->controller->request->query[$this->_dataName])) { 
				$decodedFormData = $this->decodeSectionData($this->_dataName, $this->controller->request->query[$this->_dataName]); 
				foreach ($decodedFormData as $name => $value) { 
					$this->controller->request->params[$this->_dataName][$name] = $value; 
				} 
			} 

			if (!empty($this->controller->request->query['data'])) {         
				$decodedDataData = $this->decodeSectionData('data', $this->controller->request->query['data']);
				$this->controller->request->data = $decodedDataData;
			}

            //debug($this->controller->request->data);
		} 
	} 

}
?>