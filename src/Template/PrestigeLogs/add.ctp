<!-- src/Template/PrestigeLogs/add.ctp -->
<div class="prestigeLogs form">
	<?= $this->Form->create($prestigeLog) ?>
	    <fieldset>
	        <legend><?= __('Create Prestige Log') ?></legend>
	        <?= $this->Form->input('member_id') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>