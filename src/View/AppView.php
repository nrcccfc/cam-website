<?php
namespace App\View;

use Cake\View\View;

class AppView extends View
{

	//public $layout = 'BootstrapUI.default';

	public function initialize()
	{

		//$this->loadHelper('Html', ['className' => 'BootstrapUI.Html']);
		//$this->loadHelper('Form', ['className' => 'BootstrapUI.Form']);
		//$this->loadHelper('Flash', ['className' => 'BootstrapUI.Flash']);
		//$this->loadHelper('Paginator', ['className' => 'BootstrapUI.Paginator']);
        parent::initialize();
        $this->loadHelper('Html');
        $this->loadHelper('Form');
        $this->loadHelper('Flash');
        $this->loadHelper('Access');
	}

}