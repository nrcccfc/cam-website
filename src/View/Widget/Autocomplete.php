<?php
namespace App\View\Widget;
 
use Cake\View\Form\ContextInterface;
use Cake\View\StringTemplate;
use Cake\View\Widget\Basic;
use Cake\View\Widget\Label;
use Cake\View\Widget\WidgetInterface;
use Cake\View\Widget\WidgetRegistry;
use Cake\View\View;
class Autocomplete implements WidgetInterface {
 
/**
 * Template instance.
 *
 * @var \Cake\View\StringTemplate
 */
    protected $_templates;
 
/**
 * Constructor
 *
 * @param \Cake\View\StringTemplate $templates Templates list.
 * @param \Cake\View\Widget\Basic  $input Basic widget instance.
 */
    public function __construct(StringTemplate $templates, Basic $basic, Label $label) {
        $this->_templates = $templates;
    }
 
    public function render(array $data, ContextInterface $context) {
        $data += [
            'name' => '',
            'val' => null,
            'type' => 'text',
            'escape' => true,
        ];
        $data['value'] = $data['val'];
        unset($data['val']);
 
        //debug($data);
        $result = $this->_templates->format('autocomplete', [
            'name' => $data['name'],
            'type' => $data['type'],
            'attrs' => $this->_templates->formatAttributes(
                $data,
                ['name', 'type']
            ),
        ]);

        debug($this->_view);

        //debug($context);
        //$reg = $this->load('_view');
        //debug($reg);
        //$result .= WidgetRegistry::load('_view')->Html->scriptBlock("alert('I am in the JavaScript');", ['block'=>true]);

        //debug($result);
        return $result;
    }
 
    public function secureFields(array $data) {
        return [];
    }
 
}