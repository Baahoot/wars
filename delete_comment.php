<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$com_id = $_GET['id'];
$delete = mysql_query("DELETE FROM comments WHERE id='".$com_id."'");
?>
