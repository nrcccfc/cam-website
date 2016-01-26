<!-- src/Template/PrestigeTypes/edit.ctp -->
<div class="prestigeTypes form">
	<?= $this->Form->create($prestigeType) ?>
	    <fieldset>
	        <legend><?= __('Edit PrestigeItem') ?></legend>
	        <?= $this->Form->input('name') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>