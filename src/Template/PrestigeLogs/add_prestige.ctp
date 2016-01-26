<!-- src/Template/PrestigeLogs/add_prestige.ctp -->
<div class="prestigeLogsItems form">
	<?= $this->Form->create($prestigeLogsItem) ?>
	    <fieldset>
	        <legend><?= __('Add Prestige to Log') ?></legend>
	        <?= $this->Form->hidden('prestige_log_id') ?>
	        <?= $this->Form->input('member_id', ['disabled'=>true]) ?>
	        <?= $this->Form->input('prestige_item_id') ?>
	        <?= $this->Form->input('domain_id') ?>
	        <?= $this->Form->input('venue_id', ['empty'=>__('No Venue')]) ?>
	        <?= $this->Form->input('amount') ?>
	        <?= $this->Form->input('reason') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>