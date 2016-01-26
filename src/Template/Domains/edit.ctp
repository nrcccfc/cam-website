<!-- src/Template/Domains/edit.ctp-->

<div class="Domains form">
	<?= $this->Form->create($domain) ?>
	    <fieldset>
	        <legend><?= __('Edit Domain') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?php if(count($parents)): ?>
	        	<?= $this->Form->input('parent_id', ['label'=>'Parent Domain', 'disabled'=>true]) ?>
	    	<?php endif; ?>
	        <?php if(count($domainTypes)): ?>
	        	<?= $this->Form->input('domain_type_id', ['disabled'=>true]) ?>
	    	<?php endif; ?>
	    	<?= $this->Form->input('description') ?>
	    	<?= $this->Form->input('color') ?>
	    	<?= $this->Form->input('custom_color') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>