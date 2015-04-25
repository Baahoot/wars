<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div id="Page" align="center">Welcome Back!</div>
<center>
<div style="width: 605px;" align="left">
<img src="images/HomePage/Welcome.jpg" />
<a href="https://www.facebook.com/psychowarsgame" target="_new"><img src="images/HomePage/LikeUs.jpg" /></a><br />
<img src="images/HomePage/Live-Updates.png" style="cursor: pointer;" onClick="LiveUpdates()" />
</div>
</center>
<?php include 'main.php' ?>
