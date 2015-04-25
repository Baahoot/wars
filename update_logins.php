<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$timestamp = time();
$update_logins = mysql_query("UPDATE logins_today SET logins='0'");
?>
