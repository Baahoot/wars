<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$family_id = strip_tags($_GET['id']);
// Get Family Info
$get_family = mysql_query("SELECT name,tags FROM family WHERE id=".$family_id.""); 
while($fam_info = mysql_fetch_array($get_family)) {
$fam_name = $fam_info['name'];
$fam_tags = $fam_info['tags'];
}
// Checking If Invite is found
$check_sent = mysql_query("SELECT * FROM family_invites WHERE family_id=".$family_id." AND sent_id='".$id."'");
if(mysql_num_rows($check_sent) == 0) {
	$message = die('<div class="Fail">Error: Family Invite Not Found!</div>');		
}
if(mysql_num_rows($check_sent) == 1) {
	$message = '<div class="Success">Success: <i>['.$fam_tags.']</i>'.$fam_name.'\'s Invite Declined!</div>';	
	$action = mysql_query("DELETE FROM family_invites WHERE family_id=".$family_id." AND sent_id='".$id."'");
}
echo $message;
?>
