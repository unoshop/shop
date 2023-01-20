<?


/// Send mail, store message in logs.
function _mail ($from, $to, $subj, $what)
{
	$CONFIG_MAIL_CHARSET = 'windows-1251';
	@mail ($to, $subj, $what, "From: $from\nReply-To: $from\nContent-Type: text/plain; charset=$CONFIG_MAIL_CHARSET\nContent-Transfer-Encoding: 8bit\n");
}


$msg = '';
$err = '';
$required = explode (',', $_POST["required"]);

foreach ($_POST as $var=>$value)
{
	foreach ($required as $t=>$req)
		if (trim($req) == trim($var) && trim($value)=='')
			$err.= "Required field not filled '$var'.<br>";
	$msg.= "$var: $value\n";
}

PRINT "
	<html>
	<head></head>
	<body>
	<p>&nbsp;
	<h1>Sending a message</h1>
	";

if ($err != '')
{
	PRINT "
		<p><b><font color='red'>Message not sent.</font></b> 
		<br>Errors found:
		<p>
		$err
		<p>
		Please fill out the form correctly.
		";
}
else
{
	_mail ("no-reply@1gb.ua", $_POST["recipient"], $_POST["subject"], $msg);
	
	PRINT "
		<p>Thank you.
		<p>Your message has been successfully sent to $_POST[recipient].
		<p>Our staff will contact you.
		";
}


?>
