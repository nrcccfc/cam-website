Hello <?= $username ?>,\n
It looks like you have requested a new password. You will need to use the following link (or copy-paste it into your browser) to activate it. If you didn't request a new password, please ignore this email.\n
\n
---\n
<?= 
	$this->Html->link(['controller'=>'Members', 'action'=>'resetPassword', '_full'=>true, $code]);
?>\n
---\n
\n
This link will remain active for <?= $duration; ?> hours.\n
\n
This is an automated system email. Please do not reply.\n