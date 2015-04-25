<?php session_start() ?>
<?php require 'connect.php' ?>
<body onload="BCtime()">
<?php include 'notifications.php' ?>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('bc_box')">Broadcast</div>
<?php 
$get_notifications = mysql_query("SELECT * FROM notifications WHERE owner_id=".$id.""); 
?>
<div id="SubTabs" onClick="SubTab('not_log')">Notifications (<?php echo mysql_num_rows($get_notifications); ?>)</div>
<div id="SubTabs" onClick="SubTab('topmob')">Top Mob</div>
<div id="SubTabs" onClick="SubTab('families')">Families</div>
<div id="SubTabs" onClick="SubTab('family_invites')">Family Invites</div>
<div id="SubTabs" onClick="SubTab('search')">Search</div>
</div>
</div>
<div id="SubContent"><?php include 'bc_box.php' ?></div>
