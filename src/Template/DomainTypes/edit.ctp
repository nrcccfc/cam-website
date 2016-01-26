<!-- src/Template/DomainTypes/edit.ctp-->

<div class="DomainTypes form">
	<?= $this->Form->create($domainType) ?>
	    <fieldset>
	        <legend><?= __('Edit DomainType') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?php if(count($parents)): ?>
	        	<?= $this->Form->input('parent_id', ['label'=>'Parent DomainType', 'disabled'=>true]) ?>
	    	<?php endif; ?>
	        <?php if(count($affiliates)): ?>
	        	<?= $this->Form->input('affiliate_id', ['disabled'=>true]) ?>
	    	<?php endif; ?>
	        <?= $this->Form->input('allow_members') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>