<!-- src/Template/Members/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Username'); ?></dt>
		<dd><?= h($member->username); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Email'); ?></dt>
		<dd><?= h($member->email); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($member->full_name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Assignments'); ?></dt>
		<dd><?= $this->Link->linkArray($member->assignments); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h( $member->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $member->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Reset Password', ['action'=>'resetPassword']); ?><br>
	<?= $this->Html->link('Edit User', ['action'=>'edit', $member->id]); ?><br>
	<?= $this->Html->link('Edit Email', ['action'=>'editEmail']); ?><br>
</div>