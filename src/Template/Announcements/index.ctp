<!-- File: src/Template/Announcements/index.ctp -->
<h1>Annoucements</h1>
<p><?= $this->Html->link('Add Announcement', ['action' => 'add']) ?></p>

<div id="searchField">
<?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Ajax->autoComplete('Announcements.title', array('formatResult' => "return data[0];", 'passId'=>true, 'minChars'=>2, 'div'=>false)); ?>
        <?= $this->Form->input('count', ['options'=>[5=>5, 10=>10, 25=>25, 50=>50, 100=>100], 'default'=>25, 'div'=>false]); ?>
        <?= $this->Form->input('auto_view', ['type'=>'checkbox', 'default'=>1]); ?>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>

<?php if(!empty($announcements)): ?>
<table>
    <tr>
        <th><?= $this->Paginator->sort('id'); ?></th>
        <th><?= $this->Paginator->sort('title'); ?></th>
        <th><?= $this->Paginator->sort('created'); ?></th>
        <th>Action</th>
    </tr>

    <!-- Here is where we iterate through our $announcements query object, printing out announcement info -->

    <?php foreach ($announcements as $announcement): ?>
    <tr>
        <td><?= $announcement->id ?></td>
        <td>
            <?= $this->Html->link($announcement->title,
            ['controller' => 'Announcements', 'action' => 'view', $announcement->id]) ?>
        </td>
        <td><?= $announcement->created->format(DATE_RFC850) ?></td>
        <td>
        	<?= $this->Form->postLink('Delete', ['action' => 'delete', $announcement->id], ['confirm' => 'Are you sure?']) ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $announcement->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<span>
<?= $this->Paginator->prev(' << ' . __('previous')); ?><?= $this->Paginator->numbers(['first' => 2, 'last' => 2]); ?><?= $this->Paginator->next( __('next') . ' >> '); ?>
</span>
<?php endif; ?>
<?php 
//$this->Html->scriptStart(['block' => true]);
//echo "alert('I am in the JavaScript');";
//$this->Html->scriptEnd();

//$this->Html->scriptBlock("alert('I am in the JavaScript');", ['block'=>true]);

?>