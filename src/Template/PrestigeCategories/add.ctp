<!-- src/Template/PrestigeCategories/add.ctp -->
<div class="prestigeCategories form">
	<?= $this->Form->create($prestigeCategory) ?>
	    <fieldset>
	        <legend><?= __('Create PrestigeCategory') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('affiliate_id') ?>
	        <?= $this->Form->input('monthly_limit') ?>
			<?= $this->Form->input('description') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>