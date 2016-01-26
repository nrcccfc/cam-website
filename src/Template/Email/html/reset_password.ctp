Hello <?= $username ?>,<br>
It looks like you have requested a new password. You will need to use the following link (or copy-paste it into your browser) to activate it. If you didn't request a new password, please ignore this email.<br>
<br>
---<br>
<p><?= 
	$this->Html->link(['controller'=>'Members', 'action'=>'resetPassword', '_full'=>true, $code]);
?></p><br>
---<br>
<br>
<p>This link will remain active for <?= $duration; ?> hours.</p><br>
<br>
<p>This is an automated system email. Please do not reply.<p>