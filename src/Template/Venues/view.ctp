<!-- src/Template/Venues/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Domain'); ?></dt>
		<dd><?= $this->Html->link($venue->domain->name,['controller' => 'Domains', 'action' => 'view', $venue->domain->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Game'); ?></dt>
		<dd><?= $this->Html->link($venue->game->name,['controller' => 'Games', 'action' => 'view', $venue->game->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Continuity'); ?></dt>
		<dd><?= $this->Html->link($venue->continuity->name,['controller' => 'Continuities', 'action' => 'view', $venue->continuity->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($venue->created->format(DATE_RFC850)); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $venue->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Edit Venue', ['action'=>'edit', $venue->id]); ?><br>
</div>