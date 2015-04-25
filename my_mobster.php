<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<body>
<div id="Page" align="center">My Mobster</div>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('images')">Images</div>
<div id="SubTabs" onClick="SubTab('hints')">Hints/Tips</div>
</div>
</div>
<div id="SubContent"><?php include 'images.php' ?></div>
</body>
