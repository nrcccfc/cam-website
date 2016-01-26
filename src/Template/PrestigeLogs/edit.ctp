<!-- src/Template/PrestigeLogs/edit.ctp -->
<div class="prestigeLogs form">
	<?= $this->Form->create($prestigeLog) ?>
	    <fieldset>
	        <legend><?= __('Edit Prestige Log') ?></legend>
	        <?= $this->Form->input('member_id', ['disabled'=>true]) ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>