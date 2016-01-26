<!-- src/Template/Publishers/index.ctp -->
<h1>Publishers</h1>
<p><?= $this->Html->link('Add Publisher', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Website</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($publishers as $publisher): ?>
    <tr>
        <td><?= h($publisher->id) ?></td>
        <td><?= $this->Html->link(h($publisher->name), ['controller' => 'Publishers', 'action' => 'view', h($publisher->id)]) ?></td>
        <td><?= $this->Html->link($publisher->website, 'http://'.h($publisher->website).'/', ['target' => '_blank', '_full' => true]) ?></td>
        <td><?= $publisher->created->format(DATE_RFC850) ?></td>
        <td><?= $publisher->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', h($publisher->id)]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', h($publisher->id)]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>