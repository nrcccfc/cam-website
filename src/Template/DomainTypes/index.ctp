<!-- File: src/Template/DomainType/index.ctp -->
<h1>Domain Types</h1>
<p><?= $this->Html->link('Add DomainType', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Parent Domain Type</th>
        <th>Affiliate</th>
        <th>Allow Members</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($domainTypes as $domainType): ?>
    <tr>
        <td><?= $domainType->id ?></td>
        <td>
            <?= $this->Html->link($domainType->name, ['controller' => 'DomainTypes', 'action' => 'view', $domainType->id]) ?>
        </td>
        <td> <?= isset($domainType->parent) 
            ? $this->Html->link($domainType->parent->name, ['controller' => 'DomainTypes', 'action' => 'view', $domainType->parent->id]) 
            : '<em>No parent</em>' ?> 
        </td>
        <td> <?= isset($domainType->affiliate) 
            ? $this->Html->link($domainType->affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $domainType->affiliate->id]) 
            : '<em>Universal</em>' ?> 
        </td>
        <td><?= $domainType->allow_members ? __('Yes') : __('No'); ?></td>
        <td><?= $domainType->created->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('Add Child', ['action' => 'add', $domainType->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $domainType->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>