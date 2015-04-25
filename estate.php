<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<?php
$future = $payment;
$difference = $future - time();
$minutes = floor($difference/60);
$seconds = floor($difference%60);
?>
<div id="Page" align="center">
Estate: Income $<?php echo number_format($income) ?> - 
Upkeep $<?php echo number_format($upkeep) ?> | 
Total $<?php $total_income = ($income - $upkeep); echo number_format($total_income) ?> 
In <?php echo $minutes.':'.$seconds ?>
</div>
<div id="PropResults" align="center"></div>
<?php include 'properties.php' ?>
