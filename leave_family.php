<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
if(!$id) {
	$message = die('<div class="Fail">Error: You Don\'t Have Permission To Do So!</div>');	
}
$check_fam = mysql_query("SELECT * FROM family_members WHERE mob_id='".$id."'");
$get_id = mysql_fetch_array($check_fam);
$family_id = $get_id['family_id'];
// Checking if they are in the family
$check_member = mysql_query("SELECT * FROM family_members WHERE mob_id=".$id." AND family_id=".$family_id."");
if(mysql_num_rows($check_member) == 0) {
	$message = '<div class="Fail">Error: You Don\'t Have Permission To Do So!</div>';
}
else {
	$message = '<div class="Success">Success: You Left The Family!</div>';
	$delete_members = mysql_query("DELETE FROM family_members WHERE mob_id=".$id."");	
}
echo $message;
?>
