<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$check_registered = mysql_query("SELECT * FROM register_today");
while($check = mysql_fetch_array($check_registered)) {
$check_time = $check['time'];
$time_done = strtotime('+1 day',$check_time);
$user_keygen = $check['keygen'];
$user_email = $check['email'];
if(time() >= $time_done) {
echo $user_email.' Deleted <br />';
$delete = mysql_query("DELETE FROM register_today WHERE email='".$user_email."'");
}
else {

	}
$res = $delete;	
}
?>
