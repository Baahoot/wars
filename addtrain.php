<?php session_start() ?>
<?php require 'connect.php' ?>
<div id="AttackResults"></div>
<div align="center" id="TrainJoin">Add Train
<?php 
$select_time = mysql_query("SELECT user_id,timestamp FROM addtrain WHERE user_id=".$id."");
while($add_time = mysql_fetch_array($select_time)) {
$my_time = $add_time['timestamp'];
}
// Times
$difference = $my_time - time();
$minutes = floor($difference/60);
$seconds = floor($difference%60);
// If on the addtrain
if(mysql_num_rows($select_time) == 1) {
$join = '[<span>Join Back In '.floor($minutes/60).' Hours '.floor($minutes%60).' Minutes '.floor($seconds).' Seconds</span>]';
}
else {
$join = '<span onClick="JoinTrain()">[Join]</span>';
}
echo $join;
?>
</div>
<div align="left" style="width: 600px;">
<?php
$select_addtrain = mysql_query("SELECT * FROM addtrain ORDER BY id DESC");
while($addtrain = mysql_fetch_array($select_addtrain)) {
$add_id = $addtrain['user_id'];	
$add_time = $addtrain['timestamp'];
//Select user info
$select_users = mysql_query("SELECT id,username,image FROM users WHERE id='".$add_id."'");
while($user_info = mysql_fetch_array($select_users)) {
$mob_id = $user_info['id'];
$mob_name = $user_info['username'];
$mob_image = $user_info['image'];
}
if(strlen($mob_name) > 8) {
	$mobs_name = substr($mob_name,0,8).'..';
}
if(strlen($mob_name) < 9) {
	$mobs_name = $mob_name;
}
$select_mob = mysql_query("SELECT * FROM mob WHERE sender_id='".$id."' AND sent_id='".$mob_id."'");
if(mysql_num_rows($select_mob) == 0) {
	$invite = '<div id="TrainAdd" onClick="MobInvite('.$mob_id.')">Invite</div>';
}
if(mysql_num_rows($select_mob) == 1) {
	$invite = '<div id="TrainAdd">In Mob</div>';
}
if(time() >= $add_time) {
echo '';
$delete = mysql_query("DELETE FROM addtrain WHERE user_id=".$add_id."");
}
if($add_id == '0') {
$delete_add = mysql_query("DELETE FROM addtrain WHERE user_id='0'");	
}
else {
echo 
'<div id="TrainBlock">
<div align="Center">
<div id="TrainName" onClick="ViewUser('.$mob_id.')">'.$mobs_name.'</div>
<img src="'.$mob_image.'" width="60" height="60" id="TrainImage" title="'.$mob_name.'" />
</div>
<div align="Center">'.$invite.'</div>
</div>';	
	}
}
?>
</div>
