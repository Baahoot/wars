<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<body>
<div id="Page" align="center">My Mob</div>
<div align="center">
<div align="left" id="SubTabBlock">
<div id="SubTabs" onClick="SubTab('total_mob')">Total Mob</div>
<div id="SubTabs" onClick="SubTab('invites')">Invites</div>
<div id="SubTabs" onClick="SubTab('topmob_calc')">TopMob Optimizer</div>
</div>
</div>
<div id="SubContent"><?php include 'total_mob.php' ?></div>
</body>
