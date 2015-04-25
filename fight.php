<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<body>
<div id="Page" align="center">Fight</div>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('fight_list')">Fight List</div>
<div id="SubTabs" onClick="SubTab('boss_list')">Boss List</div>
</div>
</div>
<div id="SubContent"><?php include 'fight_list.php' ?></div>
</body>
