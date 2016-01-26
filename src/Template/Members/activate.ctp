<!-- src/Template/Members/activate.ctp-->
<div class="users form">
	<?= $this->Form->create($member) ?>
	    <fieldset>
	        <legend><?= __('Create Password') ?></legend>
	        <?= $this->Form->input('password', ['type'=>'password']); ?>
	        <?= $this->Form->input('password_confirm', ['type'=>'password']); ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>