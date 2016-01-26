<!-- src/Template/Members/register.ctp -->
<div class="member form">
	<?= $this->Form->create($member) ?>
	    <fieldset>
	        <legend><?= __('Register account for another member') ?></legend>
	        <?= $this->Form->input('email') ?>
	        <?= $this->Form->input('first_name') ?>
	        <?= $this->Form->input('last_name') ?>
	        <?= $this->Form->input('domain_id') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>