<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<body>
<div id="Page" align="center">Armory</div>
<div align="center">
<div id="Results"></div>
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('limited')">Limited</div>
<div id="SubTabs" onClick="SubTab('inventory')">Inventory</div>
<div id="SubTabs" onClick="SubTab('melee')">Melee</div>
<div id="SubTabs" onClick="SubTab('guns')">Guns</div>
<div id="SubTabs" onClick="SubTab('armor')">Armor</div>
<div id="SubTabs" onClick="SubTab('bombs')">Bombs</div>
<div id="SubTabs" onClick="SubTab('vehicles')">Vehicles</div>
</div>
</div>
<div id="SubContent"><?php include 'limited.php' ?></div>
</body>
