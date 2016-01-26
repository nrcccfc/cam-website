<!-- src/Template/PrestigeLogs/edit_prestige.ctp -->
<div id='content'>
	<H1>Prestige Log</H1>
	<dl>
		<dt><?= __('Name'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeLog['member']['full_name']), ['action' => 'view', h($prestigeLog['member']['id'])] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Domain'); ?></dt>
		<dd><?= $this->Html->link(h($prestigeLog['member']['domain']['name']), ['action' => 'view', h($prestigeLog['member']['domain']['id'])] ); ?>&nbsp;</dd>
	</dl>
	<dl>
		<dt><?= __('Log'); ?></dt>
		<dd>
			<table border="1">
			    <tr>
			    	<th>Remove?</th>
			    	<th>Item</th>
			    	<th>Domain</th>
			    	<th>Venue</th>
			        <th>Amount</th>
			        <th>Reason</th>
			    </tr>

				<div class="prestigeLogsItems form">
				<?= $this->Form->create($prestigeLogsItems) ?>
					<fieldset>
					<legend><?= __('Edit Prestige Item') ?></legend>
				    <?php foreach( $prestigeLogsItems as $index=>$prestigeLogsItem ): ?>
					    <tr>
					    	<?= $this->Form->hidden($index.'.prestige_log_id') ?>
					    	<?= $this->Form->hidden($index.'.id') ?>
					    	<td><?= $this->Form->input($index.'.remove', ['label'=>"", 'type'=>'checkbox']) ?></td>
					        <td><?= $this->Form->input($index.'.prestige_item_id', ['label'=>false]) ?></td>
					        <td><?= $this->Form->input($index.'.domain_id', ['label'=>false]) ?></td>
					        <td><?= $this->Form->input($index.'.venue_id', ['label'=>false, 'empty'=>"None"]) ?></td>
					        <td><?= $this->Form->input($index.'.amount', ['label'=>false]) ?></td>
					        <td><?= $this->Form->input($index.'.reason', ['label'=>false, 'type'=>"string"]) ?></td>

					    </tr>
				    <?php endforeach; ?>
				</fieldset>	
			</table>
			<?= $this->Form->button(__('Submit')); ?>
			<?= $this->Form->end() ?>
			</div>
		</dd>
	</dl>


</div>