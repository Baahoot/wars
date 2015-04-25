<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div class="HealBlock">
<br /><br /><br />
<center><span style="font-size: 18px; color: #FFF000; font-weight: bold;">To Heal You Must Pay $<?php echo number_format($heal_cost) ?>!</span></center>
<br />
<center><input type="submit" value="Heal" onClick="Heal()" /></center>
<span id="HealResults" align="center"></span>
</div>
