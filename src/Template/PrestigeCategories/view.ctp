<!-- src/Template/PrestigeCategories/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeCategory->name), ['action' => 'view', h($prestigeCategory->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeCategory->affiliate->name),['controller' => 'Affiliates', 'action' => 'view', h($prestigeCategory->affiliate->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Monthly Limit'); ?></dt>
		<dd><?= h($prestigeCategory->monthly_limit ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($prestigeCategory->description ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($prestigeCategory->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $prestigeCategory->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add PrestigeCategory', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit PrestigeCategory', ['action'=>'edit', h($prestigeCategory->id)]); ?><br>
</div>