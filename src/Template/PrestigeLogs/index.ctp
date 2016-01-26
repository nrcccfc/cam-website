<!-- src/Template/PrestigeLogs/index.ctp -->
<h1>PrestigeLogs</h1>
<p><?= $this->Html->link('Add PrestigeLog', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Member Name</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($prestigeLogs as $prestigeLog): ?>
    <tr>
        <td>
            <?= $this->Html->link($prestigeLog->id,
            ['controller' => 'PrestigeLogs', 'action' => 'view', $prestigeLog->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($prestigeLog->member->name,
            ['controller' => 'Members', 'action' => 'view', $prestigeLog->member->id]) ?>
        </td>
        <td><?= $prestigeLog->created->format(DATE_RFC850) ?></td>
        <td><?= $prestigeLog->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $prestigeLog->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $prestigeLog->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>