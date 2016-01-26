<!-- src/Template/Publishers/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($publisher->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Website'); ?></dt>
        <dd><?= $this->Html->link(h($publisher->website), 'http://'.h($publisher->website).'/', ['target' => '_blank', '_full' => true]) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($publisher->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $publisher->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Publisher', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Publisher', ['action'=>'edit', $publisher->id]); ?><br>
</div>