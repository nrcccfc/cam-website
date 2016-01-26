<!-- src/Template/Venues/index.ctp -->
<h1>Venues</h1>
<p><?= $this->Html->link('Add Venue', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Domain</th>
        <th>Game</th>
        <th>Continuity</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($venues as $venue): ?>
    <tr>
        <td>
            <?= $this->Html->link($venue->id,
            ['controller' => 'Venues', 'action' => 'view', $venue->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($venue->domain->name,
            ['controller' => 'Domains', 'action' => 'view', $venue->domain_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($venue->game->name,
            ['controller' => 'Games', 'action' => 'view', $venue->game_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($venue->continuity->name,
            ['controller' => 'Continuities', 'action' => 'view', $venue->continuity_id]) ?>
        </td>
        <td><?= $venue->created->format(DATE_RFC850) ?></td>
        <td><?= $venue->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $venue->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $venue->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>