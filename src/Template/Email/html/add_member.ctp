Greetings,
An account has been created for you on the CaM website by <?= $creator; ?>, a member of your domain. Although your account has been created, you must still activate it before you can login. Please click on the following link or copy-paste it into your browser:<br>
<br>
---<br>
<p><?= 
	$this->Html->link(['controller'=>'Members', 'action'=>'activate', '_full'=>true, $code]);
?></p><br>
---<br>
<br>
<p>This link will remain active for <?= $duration; ?> hours. After which time, your account will be deleted.</p><br>
<br>
<p>This is an automated system email. Please do not reply.<p>