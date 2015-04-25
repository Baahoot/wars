<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$timestamp = time();
$n_new_fam_name = mysql_real_escape_string(trim($_POST['fam_name']));
$n_new_fam_tag = mysql_real_escape_string(trim($_POST['fam_tag']));
// Replace Name Symbols
$new_fam_name = preg_replace("/[^0-9a-zA-Z ]/", "", $n_new_fam_name);
$new_fam_name .= preg_replace('-', '', $n_new_fam_name);
// Replace Tag Symbols
$new_fam_tag = preg_replace("/[^0-9a-zA-Z ]/", "", $n_new_fam_tag);
$new_fam_tag .= preg_replace('-', '', $n_new_fam_tag);
// Check If In A Family
$check_family = mysql_query("SELECT * FROM family_members WHERE mob_id=".$id."");
if(mysql_num_rows($check_family) == 1) {
$message = die('<div class="Fail">Error: You\'re Already In A Family!</div>');
}
// Check Family Name
$check_fam_name = mysql_query("SELECT * FROM family WHERE name='".$new_fam_name."'");
if(mysql_num_rows($check_fam_name) == 1) {
$message = die('<div class="Fail">Error: This Name Already Belongs To A Family!</div>');
}
// Check Family Tag
$check_fam_tag = mysql_query("SELECT * FROM family WHERE tags='".$new_fam_tag."'");
if(mysql_num_rows($check_fam_tag) == 1) {
$message = die('<div class="Fail">Error: This Tag Already Belongs To A Family!</div>');
}
// Check if too short
if (strlen($new_fam_name) < 4) {
$message = die('<div class="Fail">Error: Family Name Must Be Atleast 4 Characters Long!</div>');	
}
if (strlen($new_fam_tag) < 2) {
$message = die('<div class="Fail">Error: Family Tag Must Be Atleast 2 Characters Long!</div>');	
}
// Check if too long
if (strlen($new_fam_name) > 20) {
$message = die('<div class="Fail">Error: Family Name Max Length Of 20 charaters!</div>');	
}
if (strlen($new_fam_tag) > 6) {
$message = die('<div class="Fail">Error: Family Tag Max Length Of 6 charaters!</div>');	
}
else {
$message = '<div class="Success">Success: You Created The Family Of '.$new_fam_name.' ['.$new_fam_tag.']!</div>';
$insert = mysql_query("INSERT INTO family 
(owner_id, name, tags, timestamp) 
VALUES 
('$id', '$new_fam_name', '$new_fam_tag', '$timestamp')");
$select_family = mysql_query("SELECT * FROM family WHERE owner_id='".$id."'");
while($fetch_famid = mysql_fetch_array($select_family)) {
$fetch_id = $fetch_famid['id'];	
}
$insert_member = mysql_query("INSERT INTO family_members 
(mob_id, family_id, timestamp) 
VALUES 
('$id', '$fetch_id', '$timestamp')");
}
$res = $insert & $insert_member;
echo $message;
?>
