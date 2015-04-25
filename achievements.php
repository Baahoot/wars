<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
// Missions Achievement
if($ach_missions == 3 & $missions >= 1000) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Diamond-Mission.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Diamond Missions Trophy! [1,000 Missions]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 10 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_missions='4',points=(points+10) WHERE id=".$id."");
}
if($ach_missions == 2 & $missions >= 500) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Gold-Mission.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Gold Missions Trophy! [500 Missions]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 5 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_missions='3',points=(points+5) WHERE id=".$id."");
}
if($ach_missions == 1 & $missions >= 250) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Silver-Mission.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Silver Missions Trophy! [250 Missions]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_missions='2',points=(points+3) WHERE id=".$id."");
}
if($ach_missions == 0 & $missions >= 50) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Bronze-Mission.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Bronze Missions Trophy! [50 Missions]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 1 Boss Points!</span>
</div>';	
$update = mysql_query("UPDATE users SET ach_missions='1',points=(points+1) WHERE id=".$id."");
}
// Hitman Achievement
if($ach_hitman == 3 & $bounties >= 125) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Diamond-Hitman.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Diamond Hitman Trophy! [125 Bounties]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 10 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_hitman='4',points=(points+10) WHERE id=".$id."");
}
if($ach_hitman == 2 & $bounties >= 45) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Gold-Hitman.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Gold Hitman Trophy! [45 Bounties]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 5 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_hitman='3',points=(points+5) WHERE id=".$id."");
}
if($ach_hitman == 1 & $bounties >= 15) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Silver-Hitman.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Silver Hitman Trophy! [15 Bounties]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_hitman='2',points=(points+3) WHERE id=".$id."");
}
if($ach_hitman == 0 & $bounties >= 5) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Bronze-Hitman.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Bronze Hitman Trophy! [5 Bounties]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 1 Boss Points!</span>
</div>';	
$update = mysql_query("UPDATE users SET ach_hitman='1',points=(points+1) WHERE id=".$id."");
}
// Kills Achievement
if($ach_kills == 3 & $kills >= 500) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Diamond-Kills.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Diamond Kills Trophy! [500 Kills]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 10 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_kills='4',points=(points+10) WHERE id=".$id."");
}
if($ach_kills == 2 & $kills >= 200) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Gold-Kills.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Gold Kills Trophy! [200 Kills]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 5 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_kills='3',points=(points+5) WHERE id=".$id."");
}
if($ach_kills == 1 & $kills >= 75) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Silver-Kills.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Silver Kills Trophy! [75 Kills]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_kills='2',points=(points+3) WHERE id=".$id."");
}
if($ach_kills == 0 & $kills >= 25) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Bronze-Kills.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Bronze Kills Trophy! [25 Kills]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 1 Boss Points!</span>
</div>';	
$update = mysql_query("UPDATE users SET ach_kills='1',points=(points+1) WHERE id=".$id."");
}
// Mob Size Achievement
if($ach_mobsize == 3 & $mob_size >= 1000) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Diamond-Mobsize.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Diamond Mob Size Trophy! [1,000 Mob]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 10 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_mobsize='4',points=(points+10) WHERE id=".$id."");
}
if($ach_mobsize == 2 & $mob_size >= 500) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Gold-Mobsize.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Gold Mob Size Trophy! [500 Mob]</span>
<br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 5 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_mobsize='3',points=(points+5) WHERE id=".$id."");
}
if($ach_mobsize == 1 & $mob_size >= 250) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Silver-Mobsize.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Silver Mob Size Trophy! [250 Mob]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_mobsize='2',points=(points+3) WHERE id=".$id."");
}
if($ach_mobsize == 0 & $mob_size >= 50) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Bronze-Mobsize.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Bronze Mob Size Trophy! [50 Mob]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 1 Boss Points!</span>
</div>';	
$update = mysql_query("UPDATE users SET ach_mobsize='1',points=(points+1) WHERE id=".$id."");
}
// Boss Kills Achievement
if($ach_boss == 3 & $boss_kills >= 150) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Diamond-Boss.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Diamond Boss Kills Trophy! [150 Boss Kills]</span><br />
<span style="color: #00f000; margin-top: 3px;">You Received 10 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_boss='4',points=(points+10) WHERE id=".$id."");
}
if($ach_boss == 2 & $boss_kills >= 65) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Gold-Boss.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Gold Boss Kills Trophy! [65 Boss Kills]</span><br />
<span style="color: #00f000; margin-top: 3px;">You Received 5 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_boss='3',points=(points+5) WHERE id=".$id."");
}
if($ach_boss == 1 & $boss_kills >= 45) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Silver-Boss.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Silver Boss Kills Trophy! [45 Boss Kills]</span><br />
<span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points!</span>
</div>';
$update = mysql_query("UPDATE users SET ach_boss='2',points=(points+3) WHERE id=".$id."");
}
if($ach_boss == 0 & $boss_kills >= 10) {
$message = 
'<div id="AchBlock">
<span id="AchPicture"><img src="images/achievement/Bronze-Boss.png" height="45" width="45" /></span>
<span id="AchMessage">Success: You Earned The Bronze Boss Kills Trophy! [10 Boss Kills]</span><br /><br />
<span style="color: #00f000; margin-top: 3px;">You Received 1 Boss Points!</span>
</div>';	
$update = mysql_query("UPDATE users SET ach_boss='1',points=(points+1) WHERE id=".$id."");
}
echo $message;
?>
