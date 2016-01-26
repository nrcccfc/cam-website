Greetings,\n
An account has been created for you on the CaM website by <?= $creator; ?>, a member of your domain. Although your account has been created, you must still activate it before you can login. Please click on the following link or copy-paste it into your browser:\n
\n
---\n
<?= 
	$this->Html->link(['controller'=>'Members', 'action'=>'resetEmail', '_full'=>true, $code]);
?>\n
---\n
\n
This link will remain active for <?= $duration; ?> hours.\n
\n
This is an automated system email. Please do not reply.\n