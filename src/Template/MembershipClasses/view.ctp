<!-- src/Template/MembershipClasses/view.ctp -->
<div id='content'>


	<dl>
		<dt><?= __('Level'); ?></dt>
		<dd><?= h('MC '.$membershipClass->level); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= h($membershipClass->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= h($membershipClass->affiliate->name); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('General'); ?></dt>
		<dd><?= h($membershipClass->general); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Regional'); ?></dt>
		<dd><?= h($membershipClass->regional); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('National'); ?></dt>
		<dd><?= h($membershipClass->national); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('Add Membership Class', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Membership Class', ['action'=>'edit', $membershipClass->id]); ?><br>
</div>