<!-- src/Template/Continuities/index.ctp -->
<h1>Continuities</h1>
<p><?= $this->Html->link('Add Continuity', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($continuities as $continuity): ?>
    <tr>
        <td><?= $continuity->id ?></td>
        <td><?= $this->Html->link($continuity->name, ['controller' => 'Continuities', 'action' => 'view', $continuity->id]) ?></td>
        <td><?= $continuity->start_date ?></td>
        <td><?= $continuity->end_date ?></td>
        <td><?= $continuity->created->format(DATE_RFC850) ?></td>
        <td><?= $continuity->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $continuity->id]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $continuity->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>