<!-- src/Template/Members/edit_email.ctp -->
<div class="members form">
	<?= $this->Form->create($member) ?>
	    <fieldset>
	        <legend><?= __('Please enter your new email address and password') ?></legend>
	        <?= $this->Form->input('email_temp', ['label'=>__('New Email')]) ?>
	        <?= $this->Form->input('email_password', ['label'=>__('Password'), 'type'=>'password']) ?>
	    </fieldset>
	<?= $this->Form->button(__('Send Update Email')); ?>
	<?= $this->Form->end() ?>
</div>