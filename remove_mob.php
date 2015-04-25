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
if(mysql_num_rows($check_mob) == 0) {
	$message = die('<div id="FightResults" align="center"><span class="Fail">Error: '.$vname.' Isn\'t In Your Mob!</span></div>');	
}
else {
	$message = '<span class="Success">Success: You Removed '.$vname.' From Your Mob!</span>';
	$delete = mysql_query("DELETE FROM mob WHERE sender_id='".$id."' AND sent_id='".$vid."'");
	$delete1 = mysql_query("DELETE FROM mob WHERE sender_id='".$vid."' AND sent_id='".$id."'");
	$topmob = mysql_query("DELETE FROM topmob WHERE owner_id='".$id."' AND mob_id='".$vid."'");
	$topmob1 = mysql_query("DELETE FROM topmob WHERE owner_id='".$vid."' AND mob_id='".$id."'");
	$update_mob = mysql_query("UPDATE users SET mob_size=(mob_size-1) WHERE id='".$id."'");
	$update_mob1 = mysql_query("UPDATE users SET mob_size=(mob_size-1) WHERE id='".$vid."'");	
	$not_message = 'Removed You From There Mob';
	$notification = mysql_query("INSERT INTO notifications (owner_id, user_id, message, timestamp) VALUES ('$vid', '$id', '$not_message', '".time()."')");	
}
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
