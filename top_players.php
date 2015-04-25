<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<body>
<div id="Page" align="center">Top Players</div>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('top_main')">Overall</div>
<div id="SubTabs" onClick="SubTab('top_chicago')">Chicago</div>
<div id="SubTabs" onClick="SubTab('top_ny')">New York</div>
<div id="SubTabs" onClick="SubTab('top_vegas')">Las Vegas</div>
</div>
</div>
<div id="SubContent"><?php include 'top_main.php' ?></div>
</body>
