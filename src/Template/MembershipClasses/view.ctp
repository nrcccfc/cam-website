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
		<dt><?= __('Approval Roles'); ?></dt>
		<dd>
            <?php foreach ($membershipClass->roles as $role): ?>
                <?= $this->Html->link(h($role->name), ['controller' => 'Roles', 'action' => 'view', h($role->id)])."," ?>
            <?php endforeach; ?>&nbsp;
        </dd>
	</dl>
	<dl>
		<dt><?= __('General Prestige'); ?></dt>
		<dd><?= h($membershipClass->general_prestige); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Regional Prestige'); ?></dt>
		<dd><?= h($membershipClass->regional_prestige); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('National Prestige'); ?></dt>
		<dd><?= h($membershipClass->national_prestige); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('List Membership Classes', ['action'=>'index']); ?><br>
	<?= $this->Html->link('Add Membership Class', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit Membership Class', ['action'=>'edit', $membershipClass->id]); ?><br>
</div>