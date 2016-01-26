Hello <?= $username ?>,\n
A request to change your email has been made. You will need to use the following link (or copy-paste it into your browser) to activate it. If you didn't request to update your email, please ignore this email.\n
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