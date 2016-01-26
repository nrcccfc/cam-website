<!-- src/Template/Members/reset_password.ctp -->
<div class="users form">
	<?= $this->Form->create($member) ?>
	    <fieldset>
	        <legend><?= __('Reset Password') ?></legend>
	        <?php if($is_logged_in): ?>
	        	<?= $this->Form->input('old_password', ['type'=>'password']); ?>
	        <?php endif ?>
	        <?= $this->Form->input('new_password', ['type'=>'password']); ?>
	        <?= $this->Form->input('new_password_confirm', ['type'=>'password']); ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>