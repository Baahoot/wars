<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$boss_id = strip_tags($_GET['id']);
$select_fight = mysql_query("SELECT * FROM boss_fight WHERE owner_id='".$id."' AND boss_id='".$boss_id."'");
$select_boss = mysql_query("SELECT * FROM boss_list WHERE id='".$boss_id."'");
if(mysql_num_rows($select_boss) == 0) {
$message = '<span class="Fail">Error: Boss Doesn\'t Excist!</span>';	
}
if(mysql_num_rows($select_fight) == 0) {
while($boss_info = mysql_fetch_array($select_boss)) {		
$info_name = $boss_info['name'];
$info_image = $boss_info['image'];
$info_health = $boss_info['max_health'];
$info_reward = $boss_info['reward'];
$info_time = $boss_info['time'];
$info_min = $boss_info['min_damage'];
$info_max = $boss_info['max_damage'];
$time_left = strtotime('+'.$info_time.' minutes',time());
$message = '<span class="Success">Success: You Have '.$info_time.' Minutes To Kill '.$info_name.'!</span>';	
$insert = 
mysql_query("INSERT INTO boss_fight (owner_id,boss_id,boss_name,image,health,max_health,min_damage,max_damage,reward,time) 
VALUES('$id','$boss_id','$info_name','$info_image','$info_health','$info_health','$info_min',$info_max,'$info_reward','$time_left')");
$res = $insert;
	}
}
if(mysql_num_rows($select_fight) > 0) {
while($boss_fight = mysql_fetch_array($select_fight)) {	
// Active Boss Info
// Check if times done
if(time() >= $boss_fight['time']) {	
$message = '<span class="Fail">Error: You Failed To Kill '.$boss_fight['boss_name'].' In Time!</span>';
$fight_result = '';
$exp_gain = '';	
$delete = mysql_query("DELETE FROM boss_fight WHERE owner_id='".$id."' AND boss_id='".$boss_fight['boss_id']."'");	
}
else {
$boss_name = $boss_fight['boss_name'];	
$boss_health = $boss_fight['health'];	
$boss_max_health = $boss_fight['max_health'];	
$boss_reward = $boss_fight['reward'];	
// Fight Stats
$attacker_percent = $health / $max_health * 100;
$b_min_damage = $boss_fight['min_damage'];
$b_max_damage = $boss_fight['max_damage'];
$damage_dealt = rand($b_min_damage,$b_max_damage);
$exp_gain = rand(3,15);
$fight_result = '<span class="Success">You Won!</span>';
$again = 
'<div align="center" style="color: #0FF; font-weight: bold; cursor: pointer;" onclick="BossAttack('.$boss_id.')">Attack Again</div>';
// Check Stats 
if($stamina < 1) {
$message = die('<span class="Fail">Error: You Don\'t Have Enough Stamina To Attack '.$boss_name.'!</span>');
$fight_result = '';
}
if($attacker_percent < 25) {
$message = die('<span class="Fail">Error: You Need To Heal Before Attacking '.$boss_name.'!</span>');
$fight_result = '';
}
else {
// Results
$message = 'You Attacked '.$boss_name.'! You Dealt '.number_format($damage_dealt).' Damage, While Taking '.number_format($damage_dealt - rand(6,12)).' Damage! <div id="FightEXP">You Gained '.$exp_gain.' EXP!</div>';
$update_health = mysql_query("UPDATE users SET exp=(exp+".$exp_gain."),health=(health-".($damage_dealt - rand(6,12))."),stamina=(stamina-1) WHERE id='".$id."'");
$update_boss = mysql_query("UPDATE boss_fight SET health=(health-".$damage_dealt.") WHERE owner_id='".$id."' AND boss_id='".$boss_fight['boss_id']."'");
$res = $update_boss & $update_stats;
if(($boss_health - $damage_dealt <= 0)) {
$killed = '<span id="FightKill">You Killed '.$boss_name.'! You Recieved A Reward Of $'.number_format($boss_reward).'!</span>';
$update_cash = mysql_query("UPDATE users SET cash=(cash+".$boss_reward."),boss_kills=(boss_kills+1) WHERE id='".$id."'");
$update_kill = mysql_query("DELETE FROM boss_fight WHERE owner_id='".$id."' AND boss_id='".$boss_fight['boss_id']."'");	
}
else {
	$killed = '';
	$update_cash = '';
	$update_kill = '';
}
if(($health - ($damage_dealt - rand(6,12)) <= 0)) {
$died = ' <span id="FightKill">You Died!</span>';
$update_deaths = mysql_query("UPDATE users SET health='0', deaths=(deaths+1) WHERE id='".$id."'");
}
else {
	$died = '';
	$update_deaths = '';
}
}   
}	
}
}	
echo
'<div id="FightResults">
<table width="600" align="center" style="border-bottom: 1px dotted #FFFFFF;">
  <tr>
    <td align="center" width="200" valign="middle">
    <div id="FightUser">'.$username.'</div>
    <div><img src="'.$image.'" width="50" height="50" /></div>
    </td>
    <td align="center" width="200"><img src="images/VS.png" /></td>
    <td align="center" width="200" valign="middle">
    <div id="FightUser">'.$boss_name.'</div>
    <div><img src="'.$boss_image.'" width="50" height="50" /></div>    
    </td>
  </tr>
</table>
<div id="FightResult">'.$fight_result.'</div><div id="FightMessage">'.$message.'</div>'.$killed.$died.$again.'</div>';
?>
