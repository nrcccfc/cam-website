<?php
/* src/View/Helper/ColorPickerHelper.php */
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Inflector;
class ColorPickerHelper extends AppHelper {

	public $helpers = ['Form', 'Html', 'Javascript'];


    /**
     * Returns HTML for rendering a colorpicker text box.
     *
     * the options array is used to specify attributes for the input element.
     */
    public function input($fieldName, $options = array())
    {
		// Link in javascript
		//$this->Html->script('jquery', false);
		//$this->Html->script('colorpicker', false);
		//$this->Html->css('colorpicker', NULL, array(), false);
		
		list($model, $field) = split('\.', $fieldName);

		if(isset($this->request->data[$model]) && isset($this->request->data['Owner']['color'])){
			$options['style'] = ('background:'.$this->request->data['Owner']['color']);
		}

		// Create text input
		$input = $this->Form->input($fieldName, $options);

		// Get input id
		$this->setEntity($fieldName);
		$html_attributes = $this->domId($options);
		$input_id = $html_attributes['id'];

		// Create js
		$img_base = $this->Html->url('/img/colorPicker/');
		$js = "
			jQuery(function () {
				jQuery('#$input_id').ColorPicker({
					onSubmit: function(hsb, hex, rgb, el) {
						jQuery(el).val('#' + hex);
						jQuery(el).ColorPickerHide();
						jQuery(el).css('background-color', ('#' + hex));
						

					},
					onBeforeShow: function () {
						jQuery(this).ColorPickerSetColor(this.value);
					}
				})
				.bind('keyup', function() {
					jQuery(this).ColorPickerSetColor(this.value);
					jQuery(this).css('background-color', ('#' + hex));
					
				});
			});
			";

		// Put it together
		return $input.$this->Html->scriptBlock($js);

    }

	function display($color){
		$color = '#123456';
		//return '<dd><dt style="background:'.$color.'">&nbsp;</dt></dd>';
		//return $this->Form->input('Owner.color', array('style'=>('background:'.$color), 'locked'=>true, 'div'=>false, 'label'=>false, 'value'=>$color));
		//return '<table><tr><td>'.$color.'</td><td width="20" style="background:'.$color.'">&nbsp;</td><td></td></tr></table>';
	}
}

?>