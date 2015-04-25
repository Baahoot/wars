<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
$timestamp = time();
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$user_id."'");
while($user_info = mysql_fetch_array($select_users)) {
$vid = $user_info['id'];
$vname = $user_info['username'];
}
// API End
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$user_id."'");
if(mysql_num_rows($check_mob) == 1) {
	$message = die('<div id="FightResults" align="center"><span class="Fail">Error: You\'re Already Mobbed Up!</span></div>');
}
// Check If They Invited you
$check_sent1 = mysql_query("SELECT * FROM mob_invites WHERE sender_id='".$user_id."' AND sent_id='".$id."'");
if(mysql_num_rows($check_sent1) == 0) {
	$message = die('<div id="FightResults" align="center"><span class="Fail">Error: Invite Not Found!</span></div>');
}
if($user_id == '0') {
	$message = die('<div id="FightResults" align="center"><span class="Fail">Error: Invalid ID!</span></div>');
	$delete_mob = mysql_query("DELETE FROM mob_invites WHERE sender_id='0'");
}
else {
	$message = '<span class="Success">Success: You\'re Now Mobbed Up With '.$vname.'!</span>';
	$delete = mysql_query("DELETE FROM mob_invites WHERE sender_id='".$vid."' AND sent_id='".$id."'");
	$update_mob = mysql_query("UPDATE users SET mob_size=(mob_size+1) WHERE id='".$id."'");
	$update_mob1 = mysql_query("UPDATE users SET mob_size=(mob_size+1) WHERE id='".$vid."'");
	$mob_insert = mysql_query("INSERT INTO mob 
							  (sender_id, sent_id, timestamp) 
							  VALUES 
							  ('$id', '$user_id', '$timestamp')");	
	$mob_insert1 = mysql_query("INSERT INTO mob 
							  (sender_id, sent_id, timestamp) 
							  VALUES 
							  ('$user_id', '$id', '$timestamp')");	
	// Notifications
	$not_message = 'Accepted Your Mob Invite';
	$notification = mysql_query("INSERT INTO notifications (owner_id, user_id, message, timestamp) VALUES ('$user_id', '$id', '$not_message', '".time()."')");
	$not_message1 = 'Is Now Part Of Your Mob';
	$notification1 = mysql_query("INSERT INTO notifications (owner_id, user_id, message, timestamp) VALUES ('$id', '$user_id', '$not_message1', '".time()."')");	
}
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
