<!-- src/Template/PrestigeItems/index.ctp -->
<h1>PrestigeItems</h1>
<p><?= $this->Html->link('Add PrestigeItem', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Affiliate</th>
        <th>Prestige Category</th>
        <th>Value Range</th>
        <th>Monthly Max</th>
        <th>Approval Roles</th>
        <th>Domain Types</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($prestigeItems as $prestigeItem): ?>
    <tr>
        <td>
            <?= $this->Html->link($prestigeItem->id,
            ['controller' => 'PrestigeItems', 'action' => 'view', $prestigeItem->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeItem->name,
            ['controller' => 'PrestigeItems', 'action' => 'view', $prestigeItem->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeItem->affiliate->name,
            ['controller' => 'Affiliates', 'action' => 'view', $prestigeItem->affiliate_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeItem->prestige_category->name,
            ['controller' => 'PrestigeCategories', 'action' => 'view', $prestigeItem->prestige_category_id]) ?>
        </td>
        <td><?= $prestigeItem->value_min.'-'.$prestigeItem->value_max ?></td>
        <td><?= $prestigeItem->monthly_max ?></td>
        <td>
            <?php foreach ($prestigeItem->roles as $role): ?>
                <?= $this->Html->link($role->name, ['controller' => 'Roles', 'action' => 'view', $role->id]) ?>
            <?php endforeach; ?>
        </td>
        <td>
            <?php foreach ($prestigeItem->domain_types as $domainType): ?>
                <?= $this->Html->link($domainType->name, ['controller' => 'DomainTypes', 'action' => 'view', $domainType->id]) ?>
            <?php endforeach; ?>
        </td>
        <td><?= $prestigeItem->created->format(DATE_RFC850) ?></td>
        <td><?= $prestigeItem->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $prestigeItem->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $prestigeItem->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>