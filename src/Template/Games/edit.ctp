<!-- src/Template/Games/edit.ctp-->
<div class="games form">
	<?= $this->Form->create($game) ?>
	    <fieldset>
	        <legend><?= __('Edit Game') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('abbreviation') ?>
        	<?= $this->Form->input('parent_id', ['label'=>'Parent Game', 'empty'=>true]) ?>
	        <?= $this->Form->input('description') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>