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
// Check If They Invited you
$check_sent1 = mysql_query("SELECT * FROM mob_invites WHERE sender_id='".$user_id."' AND sent_id='".$id."'");
if(mysql_num_rows($check_sent1) == 0) {
	$message = die('<div id="FightResults" align="center"><span class="Fail">Error: Invite Not Found!</span></div>');
}
else {
	$message = '<span class="Success">Success: You Declined '.$vname.'\'s Invite!</span>';
	$delete = mysql_query("DELETE FROM mob_invites WHERE sender_id='".$vid."' AND sent_id='".$id."'");
}
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
