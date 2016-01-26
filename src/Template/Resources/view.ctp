<!-- src/Template/Resources/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($resource->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($resource->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $resource->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Resource', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Resource', ['action'=>'edit', $resource->id]); ?><br>
	<?= $this->Form->postLink('Delete Resource', ['action' => 'delete', $resource->id], ['confirm' => 'Are you sure?']) ?>
</div>