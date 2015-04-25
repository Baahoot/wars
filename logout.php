<?php session_start() ?>
<?php require 'connect.php' ?>
<body bgcolor="#000000">
<meta HTTP-EQUIV="REFRESH" content="0; url=index.php">
<?php $logout = mysql_query("UPDATE users SET last_active='0' WHERE id=".$id.""); ?>
<?php session_destroy() ?>
