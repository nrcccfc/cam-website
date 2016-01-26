<!-- src/Template/Resources/update.ctp-->

<div class="resources form">
	<?= $this->Form->create() ?>
	    <fieldset>
	        <legend><?= __('Update Resources') ?></legend>

			<table>
			<?php if(count($resource) > 0): ?>
		        <?php for($i=0; $i<count($resource); $i++): ?>
		        	<tr>
		        		<td><?= $this->Form->input('Resources.'.($resource[$i]), ['options'=>['Ignore', 'Add'], 'value'=>1])?></td>
		        	</tr>
		    	<?php endfor; ?>
		    <?php else: ?>
		    	<h1>No updates found.</h1>
			<?php endif; ?>
			</table>


	   </fieldset>
	<?= $this->Form->button(__('Submit')); ?>
	<?= $this->Form->end() ?>
</div>