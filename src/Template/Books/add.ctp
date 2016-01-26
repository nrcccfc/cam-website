<!-- src/Template/Books/add.ctp -->
<div class="books form">
	<?= $this->Form->create($book) ?>
	    <fieldset>
	        <legend><?= __('Create Book') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('game_id') ?>
	        <?= $this->Form->input('publisher_id') ?>
			<?= $this->Form->input('description') ?>
			<?= $this->Form->input('website_link') ?>
			<?= $this->Form->input('image_link') ?>
			<?= $this->Form->input('isbn') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>