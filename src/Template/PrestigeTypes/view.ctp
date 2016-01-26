<!-- src/Template/PrestigeTypes/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeType->name), ['action' => 'view', h($prestigeType->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($prestigeType->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $prestigeType->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add PrestigeType', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit PrestigeType', ['action'=>'edit', h($prestigeType->id)]); ?><br>
</div>