<!-- src/Template/Roles/edit.ctp-->

<div class="roles form">
	<?= $this->Form->create($role) ?>
	    <fieldset>
	        <legend><?= __('Edit Role') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('abbreviation') ?>
	        <?php if(count($parents)): ?>
	        	<?= $this->Form->input('parent_id', ['label'=>'Parent Role', 'empty'=>true]) ?>
	    	<?php endif; ?>
	        <?= $this->Form->input('domain_type_id', ['empty'=>true, 'options'=>$domain_types]) ?>
	        <?= $this->Form->input('description') ?>
	        <?= $this->Form->input('role_limit') ?>
	        <?= $this->Form->input('is_venue_specific') ?>
			<?= $this->Form->input('resources._ids', ['type'=>'select', 'multiple'=>true, 'options' => $resources, 'size'=>20]) ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>