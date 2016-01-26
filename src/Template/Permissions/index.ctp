<!-- src/Template/Permissions/index.ctp -->
<h1>Permissions</h1>
<p><?= $this->Html->link('Add Permission', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Publisher</th>
        <th>Game</th>
        <th>Link</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($permissions as $permission): ?>
    <tr>
        <td>
            <?= $this->Html->link($permission->id,
            ['controller' => 'Permissions', 'action' => 'view', $permission->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($permission->name,
            ['controller' => 'Permissions', 'action' => 'view', $permission->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($permission->publisher->name,
            ['controller' => 'Publishers', 'action' => 'view', $permission->publisher_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($permission->game->name,
            ['controller' => 'Games', 'action' => 'view', $permission->game_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($permission->website_link, 'http://'.$permission->website_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td>
            <?= $this->Html->link($permission->image_link, 'http://'.$permission->image_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td><?= $permission->created->format(DATE_RFC850) ?></td>
        <td><?= $permission->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $permission->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $permission->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>