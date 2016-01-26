<!-- src/Template/Roles/index.ctp -->
<h1>Roles</h1>
<p><?= $this->Html->link('Add Role', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Abbreviation</th>
        <th>Parent Role</th>
        <th>Affiliate</th>
        <th>DomainType</th>
        <th>Role Limit</th>
        <th>Is Venue Specific</th>
        <th>Action</th>
    </tr>

    <?php foreach ($roles as $role): ?>
    <tr>
        <td><?= $role->id ?></td>
        <td>
            <?= $this->Html->link($role->name, ['controller' => 'Roles', 'action' => 'view', $role->id]) ?>
        </td>
        <td><?= $role->abbreviation ?></td>
        <td> <?= isset($role->parent) 
            ? $this->Html->link($role->parent->name, ['controller' => 'Roles', 'action' => 'view', $role->parent->id]) 
            : '<em>No parent</em>' ?> 
        </td>
        <td> <?= isset($role->domain_type->affiliate) 
            ? $this->Html->link($role->domain_type->affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $role->domain_type->affiliate->id]) 
            : '<em>No Affiliate</em>' ?> 
        </td>
        <td><?= $this->Html->link($role->domain_type->name, ['controller' => 'DomainTypes', 'action' => 'view', $role->domain_type->id]) ?></td>
        <td><?= $role->role_limit; ?></td>
        <td><?= $role->is_venue_specific ? __('Yes') : __('No'); ?></td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $role->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>