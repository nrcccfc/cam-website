<!-- src/Template/Domains/add.ctp -->
<div class="domains form">
	<?= $this->Form->create($domain) ?>
	    <fieldset>
	        <legend><?= __('Add Domain') ?></legend>
	        <?= $this->Form->input('id', ['type'=>'hidden']) ?>
	        <?= $this->Form->input('name') ?>
	        <?php if(count($parents)): ?>
	        	<?= $this->Form->input('parent_id', ['label'=>'Parent Domain', 'disabled'=>true]) ?>
	    	<?php endif; ?>
	    	<?= $this->Form->input('domain_type_id') ?>
	    	<?= $this->Form->input('description') ?>
	    	<?= $this->Form->input('color') ?>
	    	<?= $this->Form->input('custom_color', ['value'=>'#FF22BB']) ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>