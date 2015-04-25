<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$page = $_SERVER['PHP_SELF'];
$new_ip = $_SERVER['REMOTE_ADDR'];
// Input From Form
$email = mysql_real_escape_string($_GET['email']);
$password = mysql_real_escape_string($_GET['password']);
// Search For Valid User
$check = mysql_query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."'");
// Their's A Match
if(mysql_num_rows($check) == 1) {
	while($user_stat = mysql_fetch_array($check)) {
	$users_id = $user_stat['id'];	
	}
	$message = '<script>window.location = "http://www.psychowars.net/app/play";</script><span class="Success">Welcome Back!</span>';
	$update = mysql_query("UPDATE users SET last_login='".time()."', last_ip='".$new_ip."', last_active='".time()."' WHERE id='".$users_id."'");
	$update_logins = mysql_query("UPDATE logins_today SET logins=(logins+1)");
	$_SESSION['login'] = $email . '|' . md5 ( $email . $password );
}
else {
	$message = '<div class="Fail">Error: Invalid Login!</div>';
}
echo $message;	
?>
