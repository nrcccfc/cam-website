<!-- src/Template/Publishers/edit.ctp-->

<div class="publishers form">
	<?= $this->Form->create($publisher) ?>
	    <fieldset>
	        <legend><?= __('Edit Publisher') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('website') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>