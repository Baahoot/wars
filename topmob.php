<?php session_start() ?>
<?php require 'connect.php' ?>
<div id="MobResults"></div>
<div align="Center" id="TopMobBlock">
<div align="left">
<?php
$select_topmob = mysql_query("SELECT mob_id,bonus,energy FROM topmob WHERE owner_id='".$id."' LIMIT 9");
echo '<div id="SettingsName">Top Mob: '.(9 - mysql_num_rows($select_topmob)).' Open Slots</div>';
if(mysql_num_rows($select_topmob) == 0) {
	echo '<div class="Success" style="text-align: left;">You Have 9 Open Top Mob Slots!</div>';
}
while($topmob = mysql_fetch_array($select_topmob)) {
	$top_id = $topmob['mob_id'];
	$top_bonus = $topmob['bonus'];
	$top_energy = $topmob['energy'];
//Select user info
$select_users = mysql_query("SELECT admin,id,username,image,income,last_login FROM users WHERE id='".$top_id."' ORDER by income DESC");
while($user_info = mysql_fetch_array($select_users)) {
$user_admin = $user_info['admin'];	
$mob_id = $user_info['id'];
$mob_name = $user_info['username'];
$mob_image = $user_info['image'];
$mob_income = $user_info['income'];
$mob_bounty = $mob_income * 10;
$user_time = $user_info['last_login'];
$inactive_time = strtotime('+1 week',$user_time);
}	
// Select Sent Top Mob
$select_sent = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND mob_id='".$top_id."'");
// checking if in topmob_sent table
if(mysql_num_rows($select_sent) == 0) {
	$collect_text = '<div class="Success" align="center" title="$'.number_format($top_collect).'" onClick="TopMobBonus(\''.$mob_id.'\')" style="cursor: pointer;" id="Bonus'.$mob_id.'">[Collect Bonus]</div>';
	$energy_text = '<div class="Success" align="center" onClick="TopMobE(\''.$mob_id.'\')" style="cursor: pointer;" id="Energy'.$mob_id.'">[Send 10 Energy]</div>';
}	
while($top_sent = mysql_fetch_array($select_sent)) {
$sent_energy = $top_sent['energy'];	
$sent_bonus = $top_sent['bonus'];	
if(($select_topmob) > 0) {
	$top_collect = $mob_bounty / 2;
	// Checking If Bonus Collected
	if($sent_bonus == 0) {
		$collect_text = '<div class="Success" align="center" title="$'.number_format($top_collect).'" onClick="TopMobBonus(\''.$mob_id.'\')" style="cursor: pointer;" id="Bonus'.$mob_id.'">[Collect Bonus]</div>';
	}
	else {
		$collect_text = '<div class="Success" align="center" id="Bonus'.$mob_id.'">[Bonus Collected]</div>';
	}
	// Checking If Energy Sent	
	if($sent_energy == 0) {
		$energy_text = '<div class="Success" align="center" onClick="TopMobE(\''.$mob_id.'\')" style="cursor: pointer;" id="Energy'.$mob_id.'">[Send 10 Energy]</div>';
	}
	else {
		$energy_text = '<div class="Success" align="center" id="Energy'.$mob_id.'">[Energy Sent]</div>';
	}
// Checking if Active
if(time() > $inactive_time)	{
	$collect_text = '<div class="Fail" align="center" id="Bonus'.$mob_id.'">Inactive</div>';
	$energy_text = '<div class="Fail" align="center" id="Energy'.$mob_id.'">Inactive</div>';
}
// End Of Active check
  }
}
echo 
'<div id="MyMobBlock">
<div id="MyMobName">
<span onClick="ViewUser('.$mob_id.')" title="'.$mob_name.'">'.substr($mob_name,0,10).'..</span>  
<span class="Fail" style="cursor: pointer;" onClick="Demote('.$mob_id.')">[X]</span>
</div>
<div align="center"><img src="'.$mob_image.'" width="60" height="60" /></div>
'.$collect_text.' '.$energy_text.'
</div>';
}
?>
</div>
</div>
<br />
