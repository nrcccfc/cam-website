<!-- src/Template/Venues/edit.ctp -->
<div class="venues form">
	<?= $this->Form->create($venue) ?>
	    <fieldset>
	        <legend><?= __('Edit Venue') ?></legend>
	        <?= $this->Form->input('domain_id') ?>
	        <?= $this->Form->input('game_id') ?>
	        <?= $this->Form->input('continuity_id') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>