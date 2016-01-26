<!-- src/Template/Members/edit.ctp-->

<div class="players form">
	<?= $this->Form->create($member) ?>
	    <fieldset>
	        <legend><?= __('Edit Member') ?></legend>
	        <?= $this->Form->input('email', ['disabled'=>true]) ?>
	        <?= $this->Form->input('username', ['disabled'=>true]) ?>
	        <?= $this->Form->input('first_name') ?>
	        <?= $this->Form->input('last_name') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>