<!-- src/Template/MembershipClasses/edit.ctp-->

<div class="publishers form">
	<?= $this->Form->create($membershipClass) ?>
	    <fieldset>
	        <legend><?= __('Edit Membership Class') ?></legend>
	        <?= $this->Form->input('level') ?>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('affiliate_id') ?>
	        <?= $this->Form->input('general') ?>
	        <?= $this->Form->input('regional') ?>
	        <?= $this->Form->input('national') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>