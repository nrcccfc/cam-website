Hello <?= $username ?>,<br>
A request to change your email has been made. You will need to use the following link (or copy-paste it into your browser) to activate it. If you didn't request to update your email, please ignore this email.<br>
<br>
---<br>
<p><?= 
	$this->Html->link(['controller'=>'Members', 'action'=>'resetEmail', '_full'=>true, $code]);
?></p><br>
---<br>
<br>
<p>This link will remain active for <?= $duration; ?> hours.</p><br>
<br>
<p>This is an automated system email. Please do not reply.<p>