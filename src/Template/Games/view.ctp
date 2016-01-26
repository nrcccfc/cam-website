<!-- src/Template/Games/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($game->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('abbreviation'); ?></dt>
		<dd><?= h($game->abbreviation); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Parent'); ?></dt>
		<dd><?= isset($game->parent) 
            ? $this->Html->link($game->parent->name, ['controller' => 'Games', 'action' => 'view', $game->parent->id]) 
            : '<em>No parent</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Children'); ?></dt>
		<dd><?= $this->Link->linkArray($game->children); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Books'); ?></dt>
		<dd><?= $this->Link->linkArray($game->books); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($game->description); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Publisher'); ?></dt>
		<dd><?= h($game->publisher); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h( $game->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $game->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Game', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Game', ['action'=>'edit', $game->id]); ?><br>
	<?= $this->Form->postLink('Delete Game', ['action' => 'delete', $game->id], ['confirm' => 'Are you sure?']) ?>
</div>