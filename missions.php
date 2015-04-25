<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div id="Page" align="center">Jobs: </div>
<?php if($location == 'Las Vegas'): ?>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('mission_list')">Mission List</div>
<div id="SubTabs" onClick="SubTab('operation_list')">Operations</div>
<div id="SubTabs" onClick="SubTab('gamble')">Casino</div>
</div>
</div>
<?php else: ?>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('mission_list')">Mission List</div>
<div id="SubTabs" onClick="SubTab('operation_list')">Operations</div>
</div>
</div>
<?php endif; ?>
<div id="SubContent"><?php include 'mission_list.php' ?></div>
