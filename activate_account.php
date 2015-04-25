<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$code = strip_tags($_GET['code']);
$reg_payment = time() + 3600;
$new_ip = $_SERVER['REMOTE_ADDR'];
$timestamp = time();
$select_code = mysql_query("SELECT * FROM registered WHERE keygen='".$code."'");
while($register = mysql_fetch_array($select_code)) {
$reg_email = $register['email'];
$reg_password = $register['password'];
$reg_username = $register['username'];
$keygen = $register['keygen'];
}
if(mysql_num_rows($select_code) == 1) {
$message = '<span class="Success">Success: Account Activated! Login For Next Step!</i><span style="font-variant: small-caps;"><a href="http://www.psychowars.net/">Click Here</a></span></span>';
$register = mysql_query("INSERT INTO users 
							(email, password, username, payment, ip, joined) 
							VALUES 
							('$reg_email', '$reg_password', '$reg_username', '$reg_payment','$new_ip','".time()."')");
$move_row = mysql_query("INSERT INTO register_today 
							(email, time, ip, keygen) 
							VALUES 
							('$reg_email', '$timestamp', '$new_ip', '$keygen')");
$delete_row = mysql_query("DELETE FROM registered WHERE keygen='".$code."'");							
}
if(mysql_num_rows($select_code) == 0) {
$message = die('<span class="Fail">Error: Activation Code Doesn\'t Exist!</i></span>');	
}
echo $message;
?>
