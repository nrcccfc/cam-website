<!-- src/Template/Roles/add.ctp -->

<div class="roles form">
	<?= $this->Form->create($role) ?>
	    <fieldset>
	        <legend><?= __('Add Role') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('abbreviation') ?>
	        <?= $this->Form->input('description') ?>
	        
	        <?php if($parentId): ?>
	        	<?= $this->Form->input('domain_type_id', ['empty'=>false, 'disabled'=>$disable, 'options'=>$domain_types]) ?>
	        	<?php if(count($parents)): ?>
	        		<?= $this->Form->input('parent_id', ['label'=>'Parent Role', 'empty'=>true, 'disabled'=>true]) ?>
	        	<?php endif; ?>


	        <?php else: ?>
	        	<?= $this->Form->input('domain_type_id', ['empty'=>false, 'options'=>$domain_types]) ?>
	        	<?= $this->Form->input('parent_id', ['label'=>'Parent Role', 'empty'=>true]) ?>
	        	
	    	<?php endif; ?>
	    	<?= $this->Form->input('role_limit', ['default'=>0]) ?>
	    	<?= $this->Form->input('is_venue_specific') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>