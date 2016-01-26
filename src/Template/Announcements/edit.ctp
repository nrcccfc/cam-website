<!-- File: src/Template/Announcements/edit.ctp -->

<h1>Edit Announcement</h1>
<?php
    echo $this->Form->create($announcement);
    echo $this->Form->input('title');
    echo $this->Form->input('body', ['rows' => '3']);
    echo $this->Form->button(__('Save Announcement'));
    echo $this->Form->end();
?>