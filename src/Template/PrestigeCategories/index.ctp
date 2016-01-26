<!-- src/Template/PrestigeCategories/index.ctp -->
<h1>PrestigeCategories</h1>
<p><?= $this->Html->link('Add PrestigeCategory', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Affiliate</th>
        <th>MonthlyLimit</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($prestigeCategories as $prestigeCategory): ?>
    <tr>
        <td>
            <?= $this->Html->link($prestigeCategory->id,
            ['controller' => 'PrestigeCategories', 'action' => 'view', $prestigeCategory->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeCategory->name,
            ['controller' => 'PrestigeCategories', 'action' => 'view', $prestigeCategory->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeCategory->affiliate->name,
            ['controller' => 'Affiliates', 'action' => 'view', $prestigeCategory->affiliate_id]) ?>
        </td>
        <td><?= $prestigeCategory->monthly_limit ?></td>
        <td><?= $prestigeCategory->created->format(DATE_RFC850) ?></td>
        <td><?= $prestigeCategory->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $prestigeCategory->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $prestigeCategory->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>