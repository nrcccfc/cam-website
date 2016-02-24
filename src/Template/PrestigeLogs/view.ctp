<!-- src/Template/PrestigeLogs/view.ctp -->
<div id='content'>
	<H1>Prestige Log</H1>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeLog['member']['full_name']), ['action' => 'view', h($prestigeLog['member']['id'])] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Created'); ?></dt>
		<dd><?= h($prestigeLog['created']->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Modified'); ?></dt>
		<dd><?= h( $prestigeLog['modified']->format(DATE_RFC850) ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Log'); ?></dt>
		<dd>
			<table border="1">
			    <tr>
			    	<th>Domain</th>
			    	<th>Venue</th>
			        <th>Name</th>
			        <th>Amount</th>
			        <th>Reason</th>
			        <th>Status</th>
			        <th>Officer</th>
			        <th>Created</th>
			        <th>Updated</th>
			        <th>Locked</th>
			    </tr>

			    <?php foreach ($prestigeLog['prestige_logs_items'] as $prestigeItem): ?>
			    <tr>
			        <td><?= $this->Html->link($prestigeItem['domain']['name'], ['controller' => 'Domains', 'action' => 'view', $prestigeItem['domain']['id']]) ?></td>
			        <td><?= isset($prestigeItem['venue_id'])?$this->Html->link($prestigeItem['venue']['name'], ['controller' => 'Venues', 'action' => 'view', $prestigeItem['venue']['id']]):"None" ?>&nbsp;
			        </td>
			        <td>
			            <?= $this->Html->link($prestigeItem['prestige_item']['name'], ['controller' => 'PrestigeItems', 'action' => 'view', $prestigeItem['prestige_item']['id']]) ?>&nbsp;
			        </td>
			        <td> <?= $prestigeItem['amount'] ?> </td>
			        <td> <?= $prestigeItem['reason'] ?> </td>
			        <td><?= $statusList[$prestigeItem['status']] ?></td>

			        <td> <?= isset($prestigeItem['officer']) 
			            ? $this->Html->link($prestigeItem['officer']['username'], ['controller' => 'Members', 'action' => 'view', $prestigeItem['officer']['id']])
			            : '<em>&nbsp</em>' ?> 
			        </td>
			        <td><?= $prestigeItem['created'] ?></td>
			        <td><?= $prestigeItem['modified'] ?></td>
			        <td><?= $prestigeItem['locked'] ?></td>
			    </tr>
			    <?php endforeach; ?>
			</table>

		</dd>
	</dl>

	<dl>
		<dt><?= __('Total'); ?></dt>
		<dd><?= h( 'General: '.$prestigeTotal['Total'][0].', Regional: '.$prestigeTotal['Total'][1].', National: '.$prestigeTotal['Total'][2] ); ?>&nbsp;</dd>
	</dl>

	<dl>
		<dt><?= __('Current Membership Class'); ?></dt>
		<dd><?= h( $membershipClass['currentLevel']." (".$membershipClass['currentReqs'][0]."G, ".$membershipClass['currentReqs'][1]."R, ".$membershipClass['currentReqs'][2]."N)"); ?>&nbsp;</dd>
	</dl>

	<dl>
		<dt><?= __('Next Membership Class'); ?></dt>
		<dd><?= h( $membershipClass['nextLevel']." (".$membershipClass['nextReqs'][0]."G, ".$membershipClass['nextReqs'][1]."R, ".$membershipClass['nextReqs'][2]."N)"); ?>&nbsp;</dd>
	</dl>



<br>
	<?= $this->Html->link('Edit PrestigeLog', ['action'=>'edit', h($prestigeLog['id'])]); ?><br>
	<?= $this->Html->link('Edit PrestigeItems', ['action'=>'editPrestige', h($prestigeLog['id'])]); ?><br>
	<?= $this->Html->link('Add PrestigeItem', ['action'=>'addPrestige', h($prestigeLog['id'])]); ?><br>
	<?= $this->Html->link('Approve PrestigeItems', ['action'=>'approve', h($prestigeLog['id'])]); ?><br>

</div>