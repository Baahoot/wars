<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$timestamp = time();
$update_active = mysql_query("UPDATE users SET last_active='".$timestamp."' WHERE id=".$id."");
?>
