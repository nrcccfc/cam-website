<!-- src/Template/Assignments/add.ctp -->
<div class="assignments form">
	<?= $this->Form->create($assignment) ?>
	    <fieldset>
	        <legend><?= __('Create Assignment') ?></legend>
	        <?= $this->Form->input('member_id') ?>
	        <?= $this->Form->input('role_id') ?>
	        <?= $this->Form->input('domain_id') ?>
	        <?= $this->Form->input('venue_id', ['empty'=>__('None')]) ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>