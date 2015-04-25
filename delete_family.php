<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
if(!$id) {
	$message = die('<div class="Fail">Error: You Don\'t Have Permission To Do So!</div>');	
}
$select_owner = mysql_query("SELECT * FROM family WHERE owner_id=".$id."");
while($fam = mysql_fetch_array($select_owner)) {
$fam_id = $fam['id'];
}
if(mysql_num_rows($select_owner) == 0) {
	$message = '<span class="Fail">Error: You Don\'t Have Permission To Do So!</div>';
}
elseif(mysql_num_rows($select_owner) == 1) {
	$message = '<span class="Success">Success: Family Deleted!</div>';
	$delete_bc = mysql_query("DELETE FROM family_bc WHERE family_id=".$fam_id."");
	$delete_invites = mysql_query("DELETE FROM family_invites WHERE family_id=".$fam_id."");
	$delete_members = mysql_query("DELETE FROM family_members WHERE family_id=".$fam_id."");	
	$delete_family = mysql_query("DELETE FROM family WHERE id=".$fam_id."");	
}
echo $message;
?>
