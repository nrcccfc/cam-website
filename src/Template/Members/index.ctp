<!-- File: src/Template/Members/index.ctp -->
<h1>Members</h1>
<p><?= $this->Access->alink($access, 'Add Member', ['action' => 'add']) ?></p>

<?= $this->Form->create('Member', array('url'=>array('action'=>'index'))); ?>
<div id="searchField">
    <table width="100%">
        <tr>
            <td width="40%"><?php echo $this->Ajax->autoComplete('Members.username', array('formatResult' => "return data[0];", 'passId'=>true, 'minChars'=>2, 'label'=>__('Username'), 'div'=>false)); ?> </td>
            <td><?php echo $this->Form->input('count', array('options'=>array(5=>5,10=>10,25=>25,50=>50,100=>100), 'default'=>25, 'div'=>false, 'label'=>__('Results'))); ?></td>

            <td><?php echo $this->Form->button('Submit', ['type' => 'submit']); echo $this->Form->end();?></td>
        </tr>
    </table>
</div>  

<?php if(!empty($members)): ?>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Action</th>
    </tr>

    <?php foreach ($members as $member): ?>
    <tr>
        <td><?= $member->id ?></td>
        <td>
            <?= $this->Access->alink($access, $member->full_name,
            ['controller' => 'Members', 'action' => 'view', $member->id]) ?>
        </td>
        <td><?= $member->username ?></td>
        <td><?= $member->email ?></td>
        <td><?= $member->created->format(DATE_RFC850) ?></td>
        <td><?= $member->modified->format(DATE_RFC850) ?></td>
        <td>
            <?= $this->Access->alink($access, 'Edit', ['action' => 'edit', $member->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>