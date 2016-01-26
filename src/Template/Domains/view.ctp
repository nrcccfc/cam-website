<!-- src/Template/Domains/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($domain->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Parent'); ?></dt>
		<dd><?= isset($domain->parent) 
            ? $this->Html->link($domain->parent->name, ['action' => 'view', $domain->parent->id]) 
            : '<em>No parent</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Children'); ?></dt>
		<dd><?= $this->Link->linkArray($domain->children); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= isset($domain->affiliate) 
            ? $this->Html->link($domain->affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $domain->affiliate->id]) 
            : '<em>Universal</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($domain->description) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Color'); ?></dt>
		<dd><?= h($domain->color) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Allow Members'); ?></dt>
		<dd><?= h($domain->domain_type->allow_members) ? __('Yes') : __('No'); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h( $domain->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $domain->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Child Domain', ['action'=>'add', $domain->id]); ?><br>
	<?= $this->Html->link('Edit Domain', ['action'=>'edit', $domain->id]); ?><br>
	<?= $this->Form->postLink('Delete Domain', ['action' => 'delete', $domain->id], ['confirm' => 'Are you sure?']) ?>
</div>