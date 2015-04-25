<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
// Get user's active status
$select_user = mysql_query("SELECT * FROM users WHERE id=".$user_id."");
while($user_check = mysql_fetch_array($select_user)) {
$mob_name = $user_check['username'];
$user_time = $user_check['last_login'];
$inactive_time = strtotime('+1 week',$user_check['last_login']);
}
// Checking if Active
if(time() > $inactive_time)	{
	$message = die('<span class="Fail">Error: '.$mob_name.' Has Been Inactive For Over A Week!</span>');
}
// See if they collected 9 already today
$select_sent = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND energy='1'");
if(mysql_num_rows($select_sent) == 9) {
	$message = die('<span class="Fail" align="center">Error: You Already Sent Energy To 9 Top Mob Today!</span>');
}
// End Of Active check
// Check If You Invited Them
$select_topmob = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
while($topmob = mysql_fetch_array($select_topmob)) {
	$topmob_e = $topmob['energy'];
}
// Checking if in topmob table
$select_tm = mysql_query("SELECT * FROM topmob WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
if(mysql_num_rows($select_tm) == 1) {
if(mysql_num_rows($select_topmob) == 0) {
	$topmob_sent_add = mysql_query("INSERT INTO topmob_sent (owner_id, mob_id) VALUES ('$id', '$user_id')");
	$message = '<span class="Success">Success: You Sent 10 Energy To '.$mob_name.'!</span>';
	$update_stats = mysql_query("UPDATE users SET energy=(energy+10) WHERE id='".$user_id."'");
	$update_limit = mysql_query("UPDATE users SET topmob_energy=(topmob_energy+1) WHERE id='".$id."'");
	$update_topmob = mysql_query("UPDATE topmob_sent SET energy='1' WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
	}
}
if(mysql_num_rows($select_tm) == 0) {
	$message = die('<span class="Fail" align="center">Error: '.$mob_name.' Isn\'t In Your Top Mob!</span>');
}
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_mob) == 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: '.$mob_name.' Isn\'t In Your Mob!</span></div>');
}
if($topmob_e == '0') {	
	$message = '<span class="Success">Success: You Sent 10 Energy To '.$mob_name.'!</span>';
	$update_stats = mysql_query("UPDATE users SET energy=(energy+10) WHERE id='".$user_id."'");
	$update_limit = mysql_query("UPDATE users SET topmob_energy=(topmob_energy+1) WHERE id='".$id."'");
	$update_topmob = mysql_query("UPDATE topmob_sent SET energy='1' WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
}
if($topmob_e == '1') {	
 	$message = die('<div id="FightResults"><span class="Fail">Error: You Already Sent Energy To '.$mob_name.'!</span></div>');
}
$res = $update_stats & $update_topmob & $update_limit;
echo '<center>'.$message.'</center>';
?>
