<!-- src/Template/Members/reset_password.ctp-->

<div class="members form">
	<?= $this->Form->create() ?>
	    <fieldset>
	        <legend><?= __('Please enter your email') ?></legend>
	        <?= $this->Form->input('email') ?>
	    </fieldset>
	<?= $this->Form->button(__('Send new password')); ?>
	<?= $this->Form->end() ?>
</div>
