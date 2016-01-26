<!-- src/Template/Resources/add.ctp -->
<div class="resources form">
	<?= $this->Form->create($resource) ?>
	    <fieldset>
	        <legend><?= __('Add Resource') ?></legend>
	        <?= $this->Form->input('name') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>