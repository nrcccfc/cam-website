<!-- src/Template/PrestigeTypes/index.ctp -->
<h1>PrestigeTypes</h1>
<p><?= $this->Html->link('Add PrestigeType', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($prestigeTypes as $prestigeType): ?>
    <tr>
        <td>
            <?= $this->Html->link($prestigeType->id,
            ['controller' => 'PrestigeTypes', 'action' => 'view', $prestigeType->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeType->name,
            ['controller' => 'PrestigeTypes', 'action' => 'view', $prestigeType->id]) ?>
        </td>
        <td><?= $prestigeType->created->format(DATE_RFC850) ?></td>
        <td><?= $prestigeType->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $prestigeType->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $prestigeType->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>