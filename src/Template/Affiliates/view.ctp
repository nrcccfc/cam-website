<!-- src/Template/Affiliates/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($affiliate->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Abbreviation'); ?></dt>
		<dd><?= h($affiliate->abbreviation) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($affiliate->description); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($affiliate->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $affiliate->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Affiliation', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Affiliation', ['action'=>'edit', $affiliate->id]); ?><br>
</div>