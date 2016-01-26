<!-- src/Template/Assignments/index.ctp -->
<h1>Assignments</h1>
<p><?= $this->Html->link('Add Assignment', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Role</th>
        <th>Member Name</th>
        <th>Domain</th>
        <th>Venue</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Action</th>
    </tr>

    <?php foreach ($assignments as $assignment): ?>
    <tr>
        <td>
            <?= $this->Html->link($assignment->id,
            ['controller' => 'Assignments', 'action' => 'view', $assignment->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($assignment->role->name,
            ['controller' => 'Roles', 'action' => 'view', $assignment->role_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($assignment->member->full_name,
            ['controller' => 'Members', 'action' => 'view', $assignment->member_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($assignment->domain->name,
            ['controller' => 'Domains', 'action' => 'view', $assignment->domain_id]) ?>
        </td>
        <td> <?= isset($assignment->venue)
            ? $this->Html->link($assignment->venue->name, ['controller' => 'Venues', 'action' => 'view', $assignment->venue_id]) 
            : '<em>No venue</em>' ?>
        </td>
        <td><?= $assignment->created->format(DATE_RFC850) ?></td>
        <td><?= $assignment->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $assignment->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $assignment->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>