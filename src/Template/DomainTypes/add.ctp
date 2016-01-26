<!-- src/Template/DomainTypes/add.ctp -->
<div class="domain types form">
	<?= $this->Form->create($domainType) ?>
	    <fieldset>
	        <legend><?= __('Add DomainType') ?></legend>
	        <?= $this->Form->input('id', ['type'=>'hidden']) ?>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('parent_id', ['label'=>'Parent DomainType', 'disabled'=>true]) ?>
	    	<?= $this->Form->input('affiliate_id') ?>
	    	<?= $this->Form->input('allow_members') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>