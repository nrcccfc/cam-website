<!-- src/Template/PrestigeItems/view.ctp -->
<div id='content'>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeItem->name), ['action' => 'view', h($prestigeItem->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Affiliate'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeItem->affiliate->name),['controller' => 'Affiliates', 'action' => 'view', h($prestigeItem->affiliate->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Category'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeItem->prestige_category->name),['controller' => 'PrestigeCategories', 'action' => 'view', h($prestigeItem->prestige_category->id)] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Award Types'); ?></dt>
		<dd><?= $this->Link->linkArray($prestigeItem->prestige_types); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Award Range'); ?></dt>
		<dd><?= h($prestigeItem->value_min).'-'.h($prestigeItem->value_max) ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Monthly Limit'); ?></dt>
		<dd><?= h($prestigeItem->monthly_limit ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Domain Types'); ?></dt>
		<dd>
            <?php foreach ($prestigeItem->domain_types as $domain_type): ?>
                <?= $this->Html->link(h($domain_type->name), ['controller' => 'Roles', 'action' => 'view', h($domain_type->id)])."," ?>
            <?php endforeach; ?>&nbsp;
        </dd>
	</dl>
	<dl>
		<dt><?= __('Approval Roles'); ?></dt>
		<dd>
            <?php foreach ($prestigeItem->roles as $role): ?>
                <?= $this->Html->link(h($role->name), ['controller' => 'Roles', 'action' => 'view', h($role->id)])."," ?>
            <?php endforeach; ?>&nbsp;
        </dd>
	</dl>
	<dl>
		<dt><?= __('Description'); ?></dt>
		<dd><?= h($prestigeItem->description ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($prestigeItem->created->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $prestigeItem->modified->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
<br>
	<?= $this->Html->link('List PrestigeItems', ['action'=>'index']); ?><br>
	<?= $this->Html->link('Add PrestigeItem', ['action'=>'add']); ?><br>
	<?= $this->Html->link('Edit PrestigeItem', ['action'=>'edit', h($prestigeItem->id)]); ?><br>
</div>