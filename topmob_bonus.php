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
$user_income = $user_check['income'];
$user_bounty = $user_income * 10;
$top_collect = (5 / 100) * $user_bounty;
}
// Checking if Active
if(time() > $inactive_time)	{
	$message = die('<span class="Fail">Error: '.$mob_name.' Has Been Inactive For Over A Week!</span>');
}
// End Of Active check
// See if they collected 9 already today
$select_sent = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND bonus='1'");
if(mysql_num_rows($select_sent) == 9) {
	$message = die('<span class="Fail" align="center">Error: You Already Collected Bonus From 9 Top Mob Today!</span>');
}
// Check If You Invited Them
$select_topmob = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
while($topmob = mysql_fetch_array($select_topmob)) {
	$topmob_b = $topmob['bonus'];
}
// Checking if in topmob table
$select_tm = mysql_query("SELECT * FROM topmob WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
if(mysql_num_rows($select_tm) == 1) {
if(mysql_num_rows($select_topmob) == 0) {
	$topmob_sent_add = mysql_query("INSERT INTO topmob_sent (owner_id, mob_id) VALUES ('$id', '$user_id')");
	$message = '<span class="Success">Success: You Collected $'.number_format($top_collect).' From '.$mob_name.'!</span>';
	$update_stats = mysql_query("UPDATE users SET cash=(cash+".$top_collect.") WHERE id='".$id."'");
	$update_limit = mysql_query("UPDATE users SET topmob_bonus=(topmob_bonus+1) WHERE id='".$id."'");	
	$update_topmob = mysql_query("UPDATE topmob_sent SET bonus='1' WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
	}
}
if(mysql_num_rows($select_tm) == 0) {
	$message = die('<span class="Fail" align="center">Error: '.$mob_name.' Isn\'t In Your Top Mob!</span>');
}
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_mob) == 0) {
	$message = die('<span class="Fail">Error: '.$mob_name.' Isn\'t In Your Mob!</span>');
}
if($topmob_b == '0') {	
	$message = '<span class="Success">Success: You Collected $'.number_format($top_collect).' From '.$mob_name.'!</span>';
	$update_stats = mysql_query("UPDATE users SET cash=(cash+".$top_collect.") WHERE id='".$id."'");
	$update_limit = mysql_query("UPDATE users SET topmob_bonus=(topmob_bonus+1) WHERE id='".$id."'");	
	$update_topmob = mysql_query("UPDATE topmob_sent SET bonus='1' WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
}
if($topmob_b == '1') {	
 	$message = die('<span class="Fail">Error: You Already Collected The Bonus From '.$mob_name.'!</span></div>');
}
$res = $update_stats & $update_topmob & $update_limit;
echo '<center>'.$message.'</center>';
?>
