<!-- src/Template/Books/index.ctp -->
<h1>Books</h1>
<p><?= $this->Html->link('Add Book', ['action' => 'add']) ?></p>
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

    <?php foreach ($books as $book): ?>
    <tr>
        <td>
            <?= $this->Html->link($book->id,
            ['controller' => 'Books', 'action' => 'view', $book->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($book->name,
            ['controller' => 'Books', 'action' => 'view', $book->id]) ?>
        </td>
        <td>
            <?= $this->Html->link($book->publisher->name,
            ['controller' => 'Publishers', 'action' => 'view', $book->publisher_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($book->game->name,
            ['controller' => 'Games', 'action' => 'view', $book->game_id]) ?>
        </td>
        <td>
            <?= $this->Html->link($book->website_link, 'http://'.$book->website_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td>
            <?= $this->Html->link($book->image_link, 'http://'.$book->image_link.'/', ['target' => '_blank', '_full' => true]) ?>
        </td>
        <td><?= $book->created->format(DATE_RFC850) ?></td>
        <td><?= $book->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Html->link('View', ['action' => 'view', $book->id]) ?>
            |
            <?= $this->Html->link('Edit', ['action' => 'edit', $book->id]) ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>