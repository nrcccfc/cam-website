<!-- src/Template/PrestigeTypes/add.ctp -->
<div class="prestigeTypes form">
	<?= $this->Form->create($prestigeType) ?>
	    <fieldset>
	        <legend><?= __('Create Prestige Type') ?></legend>
	        <?= $this->Form->input('name') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>