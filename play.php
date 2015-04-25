<?php session_start() ?>
<?php require 'connect.php' ?>
<?php 
if($thanksgiving == '0') {
	include 'holidays/thanksgiving_pop.php';
}
if($christmas == '0') {
	include 'holidays/christmas_pop.php';
}
?>
<?php if(!$id){ die('<script>window.location = "index.php";</script>'); } ?>
<?php if(strlen($username) < 1) { die('<script>window.location = "choose_name";</script>');} ?>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<title>PsychoWars: <?php echo $username ?></title>
</head>
<body onLoad="XML(); BCtime()">
<?php 
$new_ip = $_SERVER['REMOTE_ADDR'];
if($ip == ''){
$update_ip = mysql_query("UPDATE users SET ip='".$new_ip."' WHERE id='".$id."'");
}
$res = $update_ip;
?>
<?php include 'stats.php' ?>
<div id="Content" align="center"><?php include 'home.php' ?></div>
<div id="Mask" onClick="ClosePop();" title="Click To Close Popup!"></div>
<div id="Mask1" onClick="ClosePop1();" title="Click To Close Popup!"></div>
<div class="PopUp" align="center"></div>
<div class="PopUp1" align="center"></div>
<div id="Update"></div>
</body>
