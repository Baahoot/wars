<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<body>
<div align="center "id="SubPage">Boss List</div>
<div id="AttackResults" align="center" class="PopUp"></div>
<?php
$select_bosses = mysql_query("SELECT * FROM boss_list ORDER BY reward");
while($boss = mysql_fetch_array($select_bosses)) {
$select_fight = mysql_query("SELECT * FROM boss_fight WHERE owner_id='".$id."' AND boss_id='".$boss['id']."'");
if(mysql_num_rows($select_fight) == 0) {	
echo
'<div id="BossBlock">
<div id="BossUsername">'.$boss['name'].'</div>
<div align="center"><img src="images/'.$boss['image'].'.png" width="150" height="65" /></div>
<div id="FightTime">Time Left: <br />[Minutes: '.$boss['time'].' | Seconds: 0]</div>
<div id="BossHealth">
Health: <span id="BossHealth'.$boss['id'].'">'.number_format($boss['max_health']).'</span>/'.number_format($boss['max_health']).'
</div>
<div id="FightReward">Reward: $'.number_format($boss['reward']).'</div>
<div align="center"><input type="submit" value="Attack" onClick="PopUp(\'boss_attack\','.$boss['id'].')" /></div>
</div>';	
}
else {
while($boss_fight = mysql_fetch_array($select_fight)) {
// Check if times done
if(time() >= $boss_fight['time']) {
$minutes = '0';
$seconds = '0';	
}	
else {
$difference = $boss_fight['time'] - time();
$minutes = floor($difference/60);
$seconds = floor($difference%60);	
}
echo
'<div id="BossBlock">
<div id="BossUsername">'.$boss_fight['boss_name'].'</div>
<div align="center"><img src="images/'.$boss_fight['image'].'.png" width="150" height="65" /></div>
<div id="FightTime">Time Left: <br />[Minutes: '.$minutes.' | Seconds: '.$seconds.']</div>
<div id="BossHealth">
Health: <span id="BossHealth'.$boss_fight['boss_id'].'">'.number_format($boss_fight['health']).'</span>/'.number_format($boss_fight['max_health']).'
</div>
<div id="FightReward">Reward: $'.number_format($boss_fight['reward']).'</div>
<div align="center"><input type="submit" value="Attack" onClick="PopUp(\'boss_attack\','.$boss['id'].')" /></div>
</div>';
	}
  }
}
?>
</body>
 
