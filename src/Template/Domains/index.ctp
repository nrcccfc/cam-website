<!-- File: src/Template/DomainType/index.ctp -->
<h1>Domains</h1>
<p><?= $this->Html->link('Add Domain', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Parent Domain</th>
        <th>Domain Type</th>
        <th>Can Assign Members</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($domains as $domain): ?>
    <tr>
        <td><?= $domain->id ?></td>
        <td><?= $this->Html->link($domain->name, ['controller' => 'Domains', 'action' => 'view', $domain->id]) ?></td>
        <td> <?= isset($domain->parent)
            ? $this->Html->link($domain->parent->name, ['controller' => 'Domains', 'action' => 'view', $domain->parent->id]) 
            : '<em>No parent</em>' ?>
        </td>
        <td><?= $this->Html->link($domain->domain_type->name, ['controller' => 'Domains', 'action' => 'view', $domain->id]) ?></td>
        <td><?= $domain->domain_type->allow_members ? __('Yes') : __('No'); ?></td>
        <td><?= $domain->created->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $domain->id]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $domain->id]) ?>
            <?= $this->Html->link('Add Child', ['action' => 'add', $domain->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>