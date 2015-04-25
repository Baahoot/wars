<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css">
<body>
<div align="center" id="NotifyTitle">Notifications: </div>
<?php
// Check mob invites
$select_invites = mysql_query("SELECT * FROM mob_invites WHERE sent_id='".$id."'");
if(mysql_num_rows($select_invites) == 0) {
$mob_invites = 'No Mob Invites';
}
elseif(mysql_num_rows($select_invites) > 0) {
$mob_invites = ''.mysql_num_rows($select_invites).' New Mob Invites! <span onClick="SubTab(\'invites\')">[View]</span>';
}
// Get Daily Bonus Time
$daily_time = $daily_bonus - time();
$d_minutes = floor($daily_time/60);
$d_seconds = floor($daily_time%60);
// Check Daily Bonus
if(time() >= $daily_bonus) {
$daily_message = '<span onClick="Collect(\'day_bonus\')">Collect Daily Bonus</span>';
}
elseif(time() < $daily_bonus) {
if($d_minutes/60 < 1) {
$d_time = floor($d_minutes).' Minutes | '.floor($d_seconds).' Seconds';
}
if($d_minutes/60 > 1) {
$d_time = floor($d_minutes/60).' Hours | '.floor($d_minutes%60).' Minutes | '.floor($d_seconds).' Seconds';	
}
$daily_message = 'Daily Bonus Collected (Collect Again In: '.($d_time).')';	
}
// Get Daily Energy Time
$energy_time = $daily_energy - time();
$e_minutes = floor($energy_time/60);
$e_seconds = floor($energy_time%60);
// Check 200 Energy
if(time() >= $daily_energy) {
$daily_energy = '<span onClick="Collect(\'energy\')">Collect 200 Energy</span>';	
}
elseif(time() < $daily_energy) {
if($e_minutes/60 < 1) {
$e_time = floor($e_minutes).' Minutes | '.floor($e_seconds).' Seconds';
}
if($e_minutes/60 > 1) {
$e_time = floor($e_minutes/60).' Hours | '.floor($e_minutes%60).' Minutes | '.floor($e_seconds).' Seconds';	
}	
$daily_energy = '200 Energy Collected (Collect Again In: '.($e_time).')';	
}
?>
<div id="Notify"><?php echo $mob_invites ?></div>
<div id="Notify"><?php echo $daily_message ?> <span id="Collectday_bonus"></span></div>
<div id="Notify"><?php echo $daily_energy ?> <span id="Collectenergy"></span></div>
</body>
