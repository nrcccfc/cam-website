<!-- src/Template/MembershipClasses/index.ctp -->
<h1>Membership Classes</h1>
<p><?= $this->Html->link('Add Membership Class', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Level</th>
        <th>Name</th>
        <th>Affiliate</th>
        <th>General</th>
        <th>Regional</th>
        <th>National</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($membershipClasses as $membershipClass): ?>
    <tr>
        <td><?= h($membershipClass->level) ?></td>
        <td><?= $this->Html->link(h($membershipClass->name), ['controller' => 'MembershipClasses', 'action' => 'view', h($membershipClass->id)]) ?></td>
        <td><?= $this->Html->link(h($membershipClass->affiliate->name), ['controller' => 'Affiliates', 'action' => 'view', h($membershipClass->affiliate->id)]) ?></td>
        <td><?= h($membershipClass->general) ?></td>
        <td><?= h($membershipClass->regional) ?></td>
        <td><?= h($membershipClass->national) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', h($membershipClass->id)]) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', h($membershipClass->id)]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>