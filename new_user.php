<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$connect = mysql_connect('localhost','baahoot_train','iamboss');
mysql_select_db('baahoot_app') or mysql_error();

$reg_payment = time() + 3600;
$reg_email = mysql_real_escape_string($_GET['reg_email']);
$reg_password = mysql_real_escape_string($_GET['reg_password']);
$reg_conf_pass = mysql_real_escape_string($_GET['reg_conf_pass']);
$reg_username = mysql_real_escape_string($_GET['reg_username']);
$new_ip = $_SERVER['REMOTE_ADDR'];
$keygen = sha1(mt_rand(10000,99999).time());
$timestamp = time();
if(strlen($reg_email) < 5) {
	$message = die('<div id="FightResults"><span class="Fail">Error: You Must Enter An Email!</span>');
}
if(strlen($reg_password) < 6) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Password Must Be At least 6 Characters Long!</span>');
}
if(strlen($reg_password) < 3) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Username Must Be At least 6 Characters Long!</span>');
}
if(strlen($reg_password) > 25) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Username Can\'t Be Over 25 Characters Long!</span>');
}
// Select from waiting activated Email
$select_waiting = mysql_query("SELECT * FROM register_today WHERE email='".$reg_email."'");
if(mysql_num_rows($select_waiting) > 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: This Email Is Waiting To Be Activated!</span>');
}
$select_ip = mysql_query("SELECT * FROM registered WHERE ip='".$new_ip."'");
if(mysql_num_rows($select_ip) > 5) {
	$message = die('<div id="FightResults"><span class="Fail">Error: You Can Only Make 5 Accounts Per Day!</span>');
}
// check email
$select_name = mysql_query("SELECT username FROM users WHERE username='".$reg_email."' LIMIT 1");
if(mysql_num_rows($select_name) > 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: This Username Is Already Taken!</span>');
}
// Select from accounts
$select_email = mysql_query("SELECT email FROM users WHERE email='".$reg_email."' LIMIT 1");
if(mysql_num_rows($select_email) > 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: This Email Has Already Been Registered!</span>');
}
if($reg_password != $reg_conf_pass) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Passwords Don\'t Match!</span>');
}
else {
	$message = '<span class="Success">Success: Check Your Email To Activate Account!</i></span>';
	$register = mysql_query("INSERT INTO registered 
							(email, password, username, time, ip, keygen) 
							VALUES 
							('$reg_email', '$reg_password', '$reg_username', '$timestamp', '$new_ip', '$keygen')");
	$subject = 'PsychoWars Account Activation';	
	$mail_message = '<html><body>';
	$mail_message .= '<p style="font-size: 16px; font-weight: bold;">Below is your account\'s activation code link:</p>';
	$mail_message .= '<p style="font-size: 15px; font-style: italic;">Activation Link: http://www.psychowars.net/app/activate_account?code='.$keygen.'</p>';
	$mail_message .= '</html></body>';
	$from = 'Admin@PsychoWars.Net';
	$headers  = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n"; 
	mail("".$reg_email."",$subject,$mail_message,$headers);
}
$res = $register;
echo mysql_error();
echo '<div id="FightResults">'.$message.'</div>';
?>
