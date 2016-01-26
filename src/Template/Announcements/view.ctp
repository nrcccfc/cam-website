<!-- File: src/Template/Announcements/view.ctp -->
<h1><?= h($announcement->title) ?></h1>
<p><?= h($announcement->body) ?></p>
<p><small>Created: <?= $announcement->created->format(DATE_RFC850) ?></small></p>