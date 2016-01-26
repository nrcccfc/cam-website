<!-- src/Template/Resources/index.ctp -->
<h1>Resources</h1>
<p><?= $this->Html->link('Add Resource', ['action' => 'add']) ?></p>
<p><?= $this->Html->link('Update From Site', ['action' => 'update']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>name</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($resources as $resource): ?>
    <tr>
        <td><?= $resource->id ?></td>
        <td><?= $this->Html->link($resource->name, ['controller' => 'Resources', 'action' => 'view', $resource->id]) ?></td>
        <td><?= $resource->created->format(DATE_RFC850) ?></td>
        <td><?= $resource->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $resource->id]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $resource->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>