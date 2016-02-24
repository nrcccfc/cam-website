<!-- src/Template/MembershipClasses/edit.ctp-->

<div class="publishers form">
	<?= $this->Form->create($membershipClass) ?>
	    <fieldset>
	        <legend><?= __('Edit Membership Class') ?></legend>
	        <?= $this->Form->input('level') ?>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('affiliate_id') ?>
	        <?= $this->Form->input('roles._ids', ['type'=>'select', 'multiple'=>'checkbox', 'options' => $roles]) ?>
	        <?= $this->Form->input('general_prestige') ?>
	        <?= $this->Form->input('regional_prestige') ?>
	        <?= $this->Form->input('national_prestige') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>