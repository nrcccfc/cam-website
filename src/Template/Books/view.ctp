<!-- src/Template/Books/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($book->name), ['action' => 'view', h($book->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Publisher'); ?></dt>
		<dd><?= $this->Html->link(h($book->publisher->name),['controller' => 'Publishers', 'action' => 'view', h($book->publisher->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Game'); ?></dt>
		<dd><?= $this->Html->link(h($book->game->name),['controller' => 'Games', 'action' => 'view', h($book->game->id)]); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Website Link'); ?></dt>
		<dd> <?= $this->Html->link(h($book->website_link), 'http://'.h($book->website_link).'/', ['target' => '_blank', '_full' => true]) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Image Link'); ?></dt>
		<dd><?= $this->Html->link(
			$this->Html->image(h($book->image_link), ['alt' => h($book->name).'_Image', 'fullbase'=>true, '?' => ['height' => 100, 'width' => 70]]), 
			'http://'.h($book->image_link).'/', 
			['target' => '_blank', '_full' => true, 'escape'=>false]) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('ISBN'); ?></dt>
		<dd><?= h($book->isbn ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($book->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $book->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Book', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Book', ['action'=>'edit', h($book->id)]); ?><br>
</div>