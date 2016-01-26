<!-- src/Template/Continuities/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($continuity->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Start Date'); ?></dt>
		<dd><?= h($continuity->start_date); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('End Date'); ?></dt>
		<dd><?= h($continuity->end_date) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Games'); ?></dt>
		<dd><?= $this->Link->linkArray($continuity->games, ['controller'=>'Games']); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($continuity->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $continuity->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Continuity', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Continuity', ['action'=>'edit', $continuity->id]); ?><br>
	<?= $this->Form->postLink('Delete Continuity', ['action' => 'delete', $continuity->id], ['confirm' => 'Are you sure?']) ?>
</div>