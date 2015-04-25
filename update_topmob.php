<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$count = 1;
$select_topmob = mysql_query("SELECT * FROM topmob");
while ($row = mysql_fetch_array($select_topmob)) {	
$update_topmob = mysql_query("DELETE FROM topmob_sent WHERE owner_id='".$row['owner_id']."'");
}
$res = $update_topmob;
?>
<?php
$count = 1;
$select_users = mysql_query("SELECT * FROM users");
while ($row = mysql_fetch_array($select_users)) {	
$update = mysql_query("UPDATE users SET topmob_bonus='0',topmob_energy='0' WHERE id='".$row['id']."'");
}
$res = $update;
?>
