<!-- src/Template/DomainTypes/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($domainType->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Parent'); ?></dt>
		<dd><?= isset($domainType->parent) 
            ? $this->Html->link($domainType->parent->name, ['action' => 'view', $domainType->parent->id]) 
            : '<em>No parent</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Children'); ?></dt>
		<dd><?= $this->Link->linkArray($domainType->children); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= isset($domainType->affiliate) 
            ? $this->Html->link($domainType->affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $domainType->affiliate->id]) 
            : '<em>Universal</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Allow Members'); ?></dt>
		<dd><?= h($domainType->allow_members)? __('Yes') : __('No'); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h( $domainType->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $domainType->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Child DomainType', ['action'=>'add', $domainType->id]); ?><br>
	<?= $this->Html->link('Edit DomainType', ['action'=>'edit', $domainType->id]); ?><br>
	<?= $this->Form->postLink('Delete DomainType', ['action' => 'delete', $domainType->id], ['confirm' => 'Are you sure?']) ?>
</div>