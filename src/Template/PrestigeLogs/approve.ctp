<!-- src/Template/PrestigeLogs/approve.ctp -->
<div id='content'>
	<H1>Prestige Approvals</H1>
	<dl>
		<dd>
			<?php if(count($prestigeLogsItems)): ?>
				<table border="1">
				    <tr>
				    	<th><?= __("Member Name") ?></th>
				    	<th><?= __("Domain") ?></th>
				    	<th><?= __("Venue") ?></th>
				    	<th><?= __("Item") ?></th>
				        <th><?= __("Reason") ?></th>
				        <th><?= __("Amount") ?></th>
				        <th><?= __("Deny Reason") ?></th>
				        <th><?= __("Action?") ?></th>
				    </tr>

					<div class="prestigeLogsItems form">
					<?= $this->Form->create($prestigeLogsItems) ?>
						<fieldset>
						<legend><?= __('Approve Prestige Items') ?></legend>
					    <?php foreach( $prestigeLogsItems as $index=>$prestigeLogsItem ): ?>
						    <tr>
						    	<?= $this->Form->hidden($index.'.id') ?>
						    	<?= $this->Form->hidden($index.'.officer_id', ['value'=>$officerId]) ?>
						    	<td><?= $this->Html->link($prestigeLogsItem->prestige_log->member->full_name, ['controller' => 'Members', 'action' => 'view', $prestigeLogsItem->prestige_log->member->id]).' ['.$this->Html->link( __('Log'), ['controller' => 'PrestigeLogs', 'action' => 'view', $prestigeLogsItem->prestige_log->id]).']' ?>&nbsp;</td>
						    	<td><?= $this->Html->link($prestigeLogsItem->domain->name, ['controller' => 'Domains', 'action' => 'view', $prestigeLogsItem->domain->id]) ?>&nbsp;</td>
						    	<td><?= isset($prestigeLogsItem->venue)?$this->Html->link($prestigeLogsItem->venue->name, ['controller' => 'Venues', 'action' => 'view', $prestigeLogsItem->venue->id]):__("None") ?>&nbsp;</td>
						    	<td><?= $prestigeLogsItem->prestige_item->name." ".$prestigeLogsItem->prestige_item->range ?>&nbsp;</td>
						    	<td><?= $this->Form->input($index.'.reason', ['label'=>false, 'type'=>"string"]) ?>&nbsp;</td>
						    	<td><?= $this->Form->input($index.'.amount', ['label'=>false]) ?></td>
						        <td><?= $this->Form->input($index.'.deny_reason', ['label'=>false, 'type'=>"string"]) ?>&nbsp;</td>
						        <td><?= $this->Form->input($index.'.status', ['label'=>false, 'empty'=>' ', 'options'=>$approvalList]) ?></td>






						    </tr>
					    <?php endforeach; ?>
					</fieldset>	
				</table>
				<?= $this->Form->button(__('Submit')); ?>
				<?= $this->Form->end() ?>
			<?php else: ?>
				<?= __('No prestige items need approval.') ?>
			<?php endif; ?>
			</div>
		</dd>
	</dl>


</div>