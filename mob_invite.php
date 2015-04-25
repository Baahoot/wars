<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
$timestamp = time();
// Fetch Users Stats
$select_user = mysql_query("SELECT * FROM users WHERE id='".$user_id."'");
while($user = mysql_fetch_array($select_user)) {
$users_name = $user['username'];	
}
// Check If Inviting Self
if($id == $user_id) {
$message = die('<div id="FightResults" align="center"><span class="Fail" align="center">Error: You Can\'t Invite Yourself!</span></div>');
}
// Check If You Invited Them
$check_sent = mysql_query("SELECT * FROM mob_invites WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_sent) == 1) {
	$message = die('<div id="FightResults" align="center"><span class="Fail" align="center">Error: You Already Sent An Invite To '.$users_name.'!</span></div>');
}
// Check If They Invited you
$check_sent1 = mysql_query("SELECT * FROM mob_invites WHERE sender_id='".$user_id."' AND sent_id='".$id."'");
if(mysql_num_rows($check_sent1) == 1) {
	$message = die('<div id="FightResults"><span class="Fail">Error: '.$users_name.' Already Invited You! <span class="Success" onClick="FindTab(\'my_mob\')" style="cursor: pointer;">[Check Invites]</span></span></div>');
}
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_mob) == 1) {
	$message = die('<div id="FightResults"><span class="Fail">Error: You\'re Already Mobbed Up With '.$users_name.'!</span></div>');
}
else {
	$message = '<span class="Success">Success: Invite Sent To '.$users_name.'!</span>';
	$sent_insert = mysql_query("INSERT INTO mob_invites 
							  (sender_id, sent_id, timestamp) 
							  VALUES 
							  ('$id', '$user_id', '$timestamp')");	
}
$res = $sent_insert;
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
