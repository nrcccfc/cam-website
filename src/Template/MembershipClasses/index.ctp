<!-- src/Template/MembershipClasses/index.ctp -->
<h1>MembershipClasses</h1>
<p><?= $this->Html->link('Add MembershipClass', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Publisher</th>
        <th>Game</th>
        <th>Website Link</th>
        <th>Image Link</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($membershipclasses as $membershipclass): ?>
    <tr>
        <td>
            <?= $this->Html->link($membershipclass->id,
            ['controller' => 'MembershipClasses', 'action' => 'view', $membershipclass->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($membershipclass->name,
            ['controller' => 'MembershipClasses', 'action' => 'view', $membershipclass->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($membershipclass->publisher->name,
            ['controller' => 'Publishers', 'action' => 'view', $membershipclass->publisher_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($membershipclass->game->name,
            ['controller' => 'Games', 'action' => 'view', $membershipclass->game_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($membershipclass->website_link, 'http://'.$membershipclass->website_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td>
            <?= $this->Html->link($membershipclass->image_link, 'http://'.$membershipclass->image_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td><?= $membershipclass->created->format(DATE_RFC850) ?></td>
        <td><?= $membershipclass->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $membershipclass->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $membershipclass->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>