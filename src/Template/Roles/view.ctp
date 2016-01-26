<!-- src/Template/Roles/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($role->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Abbreviation'); ?></dt>
		<dd><?= h($role->abbreviation); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Parent'); ?></dt>
		<dd><?= isset($role->parent) 
            ? $this->Html->link($role->parent->name, ['controller' => 'Roles', 'action' => 'view', $role->parent->id]) 
            : '<em>No parent</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Children'); ?></dt>
		<dd><?= isset($role->children) 
            ? $this->Link->linkArray($role->children)
            : '<em>No Children</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Domain Type'); ?></dt>
		<dd><?= $this->Html->link($role->domain_type->name, ['controller' => 'DomainTypes', 'action' => 'view', $role->domain_type->id]) ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= isset($role->affiliate) 
            ? $this->Html->link($role->domain_type->affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $role->domain_type->affiliate->id]) 
            : '<em>Universal</em>' ?> &nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($role->description); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Role Limit'); ?></dt>
		<dd><?= h($role->role_limit); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Is Venue Specific'); ?></dt>
		<dd><?= h($role->is_venue_specific)? __('Yes') : __('No'); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Resources'); ?></dt>
		<dd><?= $this->Link->linkArray($role->resources); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h( $role->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $role->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Child Role', ['action'=>'add', $role->id]); ?><br>
	<?= $this->Html->link('Edit Role', ['action'=>'edit', $role->id]); ?><br>
	<?= $this->Form->postLink('Delete Role', ['action' => 'delete', $role->id], ['confirm' => 'Are you sure?']) ?>
</div>