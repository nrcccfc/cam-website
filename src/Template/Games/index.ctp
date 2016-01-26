<!-- src/Template/Games/index.ctp -->
<h1>Games</h1>
<p><?= $this->Html->link('Add Game', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Abbreviation</th>
        <th>Parent Game</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($games as $game): ?>
    <tr>
        <td><?= $game->id ?></td>
        <td>
            <?= $this->Html->link($game->name, ['controller' => 'Games', 'action' => 'view', $game->id]) ?>
        </td>
        <td><?= $game->abbreviation ?></td>
        <td> <?= isset($game->parent) 
            ? $this->Html->link($game->parent->name, ['controller' => 'Games', 'action' => 'view', $game->parent->id]) 
            : '<em>No parent</em>' ?> 
        </td>
        <td><?= $game->created->format(DATE_RFC850) ?></td>
        <td><?= $game->modified->format(DATE_RFC850) ?></td>
        <td>
            [<?= $this->Html->link('View', ['action' => 'view', $game->id]) ?>]
            [<?= $this->Html->link('Add Child', ['action' => 'add', $game->id]) ?>]
            [<?= $this->Html->link('Edit', ['action' => 'edit', $game->id]) ?>]
        </td>
    </tr>
    <?php endforeach; ?>
</table>