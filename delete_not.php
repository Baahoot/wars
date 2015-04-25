<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$not_id = $_GET['id'];
$delete = mysql_query("DELETE FROM notifications WHERE id='".$not_id."'");
?>
