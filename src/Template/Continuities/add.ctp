<!-- src/Template/Continuities/add.ctp -->
<div class="continuities form">
	<?= $this->Form->create($continuity) ?>
	    <fieldset>
	        <legend><?= __('Add Continuity') ?></legend>
	        <?= $this->Form->input('start_date') ?>
	        <?= $this->Form->input('end_date') ?>
	        <?= $this->Form->input('games._ids', ['options' => $games, 'multiple'=>true]) ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>