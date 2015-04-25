<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $user_id ) )
{
	$user_id = mysql_real_escape_string($user_id);
	$sql = "SELECT * FROM users WHERE id='".$user_id."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else {
		$userp = 'Error';
	}
}
?>
<?php
$timestamp = time();
// check if knuckles
if($knuckles > 0) {
$get_damage = $knuckles + rand(1,5);	
$punch_damage = rand($get_damage,($get_damage + 2));
}
if($knuckles == 0) {
$punch_damage = rand(1,5);	
}
if($stamina == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Any Stamina To Punch '.$userp['username'].'!</span></div>');
}
// Check if self
if($user_id == $id) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Can\'t Punch Yourself!</span></div>');
}
// See if they're on the hitlist
$hitlist_check = mysql_query("SELECT * FROM hitlist WHERE listed_id='".$userp['id']."'"); 
if (mysql_num_rows($hitlist_check) > 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: '.$userp['username'].'\'s On The Hitlist!</span></div>');
}
if($userp['health'] < 1) {
$message = die('<div id="FightResults"><span class="Fail">Error: '.$userp['username'].'\'s Already Dead!</span></div>');
}
elseif($userp['health'] > 0) {	
$message = '<div class="Success">You Punched '.$userp['username'].' In The Face Dealing '.$punch_damage.' Damage!</div>';
$punch_stam = mysql_query("UPDATE users SET stamina=(stamina-1) WHERE id='".$id."'");
$punch_update = mysql_query("UPDATE users SET health=(health-".$punch_damage.") WHERE id='".$user_id."'");
$log_message = '<div id="LogFail">[Punch]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Punched You In The Face Dealing '.$punch_damage.' Damage!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$user_id','$log_message','$timestamp')");
if($userp['health'] - $punch_damage <= 0) {
	$death_message = '<span id="FightKill">You Killed '.$userp['username'].'!</span>';
	$log_message = '<div id="LogFail">[Punch]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Punched You In The Face Dealing '.$punch_damage.' Damage! You Died!</div>';
	$punch_death = mysql_query("UPDATE users SET deaths=(deaths+1),health='0' WHERE id='".$userp['id']."'");
	$punch_kill = mysql_query("UPDATE users SET kills=(kills+1) WHERE id='".$id."'");
	$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$user_id','$log_message','$timestamp')");	
}
else {
	$punch_death = '';
	$punch_kill = '';
	}
}
echo '<div align="center" id="FightResults">'.$message.' '.$death_message.'</div>';
$res = $punch_update & $punch_death & $punch_kill & $log_enter;
?>
