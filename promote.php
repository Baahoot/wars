<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
//Select user info
$select_member = mysql_query("SELECT * FROM users WHERE id='".$user_id."'");
while($member_info = mysql_fetch_array($select_member)) {
$member_id = $member_info['id'];
$member_name = $member_info['username'];
$member_image = $member_info['image'];
}
// Check Sent
$select_sent = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
// Check If You Invited Them
$select_topmob = mysql_query("SELECT * FROM topmob WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
if(mysql_num_rows($select_topmob) == 1) {
	$message = die('<div id="FightResults" align="center"><span class="Fail" align="center">Error: '.$member_name.'\'s Already In Your Top Mob!</span></div>');
}
// Check if open slots
$select_top6 = mysql_query("SELECT * FROM topmob WHERE owner_id='".$id."'");
if(mysql_num_rows($select_top6) == 9) {
	$message = die('<div id="FightResults" align="center"><span class="Fail" align="center">Error: You Don\'t Have Any Open Top Mob Slots!</span></div>');
}
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_mob) == 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: '.$member_name.' Isn\'t In Your Mob!</span></div>');
}
else {
	$message = '<span class="Success">Success: '.$member_name.' Promoted To Your Top Mob!</span>';
	$topmob_add = mysql_query("INSERT INTO topmob 
							  (owner_id, mob_id) 
							  VALUES 
							  ('$id', '$member_id')");
	// Notifications
	$not_message = 'Promoted You To There TopMob';
	$notification = mysql_query("INSERT INTO notifications (owner_id, user_id, message, timestamp) VALUES ('$user_id', '$id', '$not_message', '".time()."')");							  
if(mysql_num_rows($select_sent) == 0) {								  	
	$topmob_send = mysql_query("INSERT INTO topmob_sent (owner_id, mob_id) VALUES ('$id', '$member_id')");							  
}
elseif(mysql_num_rows($select_sent) > 0) {
	$topmob_send = '';
	}
}
$res = $topmob_add & $topmob_send;
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
