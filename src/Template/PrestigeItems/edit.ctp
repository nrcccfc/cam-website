<!-- src/Template/PrestigeItems/edit.ctp -->
<div class="prestigeItems form">
	<?= $this->Form->create($prestigeItem) ?>
	    <fieldset>
	        <legend><?= __('Edit Prestige Item') ?></legend>
	        <?= $this->Form->input('name') ?>
	        <?= $this->Form->input('affiliate_id') ?>
	        <?= $this->Form->input('prestige_category_id') ?>
	        <?= $this->Form->input('value_min') ?>
	        <?= $this->Form->input('value_max') ?>
	        <?= $this->Form->input('monthly_limit') ?>
	        <?= $this->Form->input('roles._ids', ['type'=>'select', 'multiple'=>'checkbox', 'options' => $roles]) ?>
	        <?= $this->Form->input('domain_types._ids', ['type'=>'select', 'multiple'=>'checkbox', 'options' => $domainTypes]) ?>
			<?= $this->Form->input('description') ?>
	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>