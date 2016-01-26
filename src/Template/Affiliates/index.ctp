<!-- src/Template/Affiliates/index.ctp -->
<h1>Affiliates</h1>
<p><?= $this->Html->link('Add Affiliate', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Abbreviation</th>
        <th>Description</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <?php foreach ($affiliates as $affiliate): ?>
    <tr>
        <td><?= $affiliate->id ?></td>
        <td><?= $this->Html->link($affiliate->name, ['controller' => 'Affiliates', 'action' => 'view', $affiliate->id]) ?></td>
        <td><?= $affiliate->abbreviation ?></td>
        <td><?= $affiliate->description ?></td>
        <td><?= $affiliate->created->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $affiliate->id]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $affiliate->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>