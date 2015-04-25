<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<title>PsychoWars</title>
<body>
<?php if(!$id): ?>
<div align="center"><?php include 'images/PsychoWarsHome.html' ?></div>
<?php else: ?>
<script>window.location = "http://www.psychowars.net/app/play";</script>
<?php endif; ?>
<div id="Content" align="center"><?php include 'home_page.php' ?></div>
</body>
