<!-- src/Template/MembershipClasses/add.ctp -->
<div class="membershipclasses form">
	<?= $this->Form->create($membershipClass) ?>
	    <fieldset>
	        <legend><?= __('Add Membership Class') ?></legend>
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
