<!-- File: src/Template/Announcements/add.ctp -->

<h1>Add Announcements</h1>
<?php
    echo $this->Form->create($announcement);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Announcements'));
    echo $this->Form->end();
?>