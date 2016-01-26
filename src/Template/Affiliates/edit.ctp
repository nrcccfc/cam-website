<!-- src/Template/Affiliates/edit.ctp-->

<div class="affiliates form">
	<?= $this->Form->create($affiliate) ?>
	    <fieldset>
	        <legend><?= __('Edit Affiliate') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('abbreviation') ?>
	        <?= $this->Form->input('description') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>