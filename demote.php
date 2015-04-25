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
// Check If You Invited Them
$select_topmob = mysql_query("SELECT * FROM topmob WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
if(mysql_num_rows($select_topmob) == 0) {
	$message = die('<div id="FightResults" align="center"><span class="Fail" align="center">Error: '.$member_name.' Isn\'t In Your Top Mob!</span></div>');
}
else {
	$message = '<span class="Success">Success: '.$member_name.' Demoted From Your Top Mob!</span>';
	$remove = mysql_query("DELETE FROM topmob WHERE owner_id='".$id."' AND mob_id='".$member_id."'");	
	// Notifications
	$not_message = 'Demoted You From There TopMob';
	$notification = mysql_query("INSERT INTO notifications (owner_id, user_id, message, timestamp) VALUES ('$user_id', '$id', '$not_message', '".time()."')");	
}
$res = $remove;
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
