<!-- src/Template/Assignments/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Member'); ?></dt>
		<dd><?= $this->Html->link($assignment->member->full_name,['controller' => 'Members', 'action' => 'view', $assignment->member->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Role'); ?></dt>
		<dd><?= $this->Html->link($assignment->role->name,['controller' => 'Roles', 'action' => 'view', $assignment->role->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Domain'); ?></dt>
		<dd><?= $this->Html->link($assignment->domain->name,['controller' => 'Domains', 'action' => 'view', $assignment->domain->id]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Venue'); ?></dt>
		<dd><?= isset($assignment->venue) 
            ? $this->Html->link($assignment->venue->name, ['controller' => 'Venues', 'action' => 'view', $assignment->venue->id]) 
            : '<em>Universal</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($assignment->created->format(DATE_RFC850)); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $assignment->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Edit Assignment', ['action'=>'edit', $assignment->id]); ?><br>
	<?= $this->Form->postLink('Delete Assignment', ['action' => 'delete', $assignment->id], ['confirm' => 'Are you sure?']) ?>
</div>