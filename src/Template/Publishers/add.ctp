<!-- src/Template/Publishers/add.ctp -->
<div class="publishers form">
	<?= $this->Form->create($publisher) ?>
	    <fieldset>
	        <legend><?= __('Add Publisher') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('website') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>