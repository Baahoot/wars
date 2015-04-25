<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
$timestamp = time();
// Get My Family
$my_family = mysql_query("SELECT * FROM family WHERE owner_id=".$id."");
while($myfam = mysql_fetch_array($my_family)) {
$my_fam_id = $myfam['id'];	
}
// Checking If Valid User
$select_user = mysql_query("SELECT * FROM users WHERE id='".$user_id."'");
if(mysql_num_rows($select_user) == 0) {
	$message = die('<div class="Fail">Error: You Must Enter A Valid ID!</div>');		
}
while($user = mysql_fetch_array($select_user)) {
$invite_name = $user['username'];
}
// Checking If Already Sent
$check_sent = mysql_query("SELECT * FROM family_invites WHERE sent_id='".$user_id."' AND sender_id=".$id."");
if(mysql_num_rows($check_sent) > 0) {
	$message = die('<div class="Fail">Error: You Already Sent An Invite To '.$invite_name.'!</div>');		
}
// Checking If In A Family
$check_fam = mysql_query("SELECT * FROM family_members WHERE mob_id='".$user_id."'");
if(mysql_num_rows($check_sent) > 0) {
	$message = die('<div class="Fail">Error: '.$invite_name.' Is Currently In A Family!</div>');		
}
// Checking	
if(!$id) {
	$message = die('<div class="Fail">Error: You Don\'t Have Permission To Do So!</div>');	
}
if($user_id == $id) {
	$message = die('<div class="Fail">Error: You Can\'t Invite Yourself!</div>');	
}
$select_owner = mysql_query("SELECT * FROM family WHERE owner_id=".$id."");
if(mysql_num_rows($select_owner) == 0) {
	$message = '<span class="Fail">Error: You Don\'t Have Permission To Do So!</div>';
}
elseif(mysql_num_rows($select_owner) == 1) {
	$message = '<span class="Success">Success: '.$invite_name.' Invited!</div>';
	$insert = mysql_query("INSERT INTO family_invites 
	(sender_id, sent_id, family_id, timestamp) 
	VALUES 
	('$id', '$user_id', '$my_fam_id', '$timestamp')"); 
	$res = $insert;
}
echo $message;	
?>
