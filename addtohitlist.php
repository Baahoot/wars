<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$fetchstats = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $fetchstats ) )
{
	$fetchstats = mysql_real_escape_string($fetchstats);
	$sql = "SELECT * FROM users WHERE id='".$fetchstats."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else
	{ 
	exit;
	}
}
else
{
	exit;
}
?>
<?php
// Variables for inserting
$timestamp = time();
$listed_id = $userp['id'];
$listed_name = $userp['username'];
$user_image = $userp['image'];
$timestamp = time();
// Amount And Fee
$amount = str_replace(',', '', $_GET['amount']);
$list_feee = (10 / 100) * $amount;
$list_fee = $amount - $list_feee;
// See if they're on the hitlist
$hitlist_check = mysql_query("SELECT * FROM hitlist WHERE listed_id='".$userp['id']."'"); 
if (mysql_num_rows($hitlist_check) > 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: '.$userp['username'].'\'s Already On The Hitlist!</span></div>');
}
if ($userp['id'] == $id) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Can\'t Set A Bounty On Your Own Head!</div></div');
}
if ($userp['health'] == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Can\'t Set A Bounty On A Dead Man!</div></div');
}
if ($stamina == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Must Have Atleast 1 Stamina!</span></div');
}
if ($amount < ($userp['income'] * 10)) {
$message = die('<div id="FightResults"><span class="Fail">Error: Minimum Fee Of $'.number_format($userp['income']*10).' To Hitlist '.$userp['username'].'!</span></div>');
}
if ($cash < $amount) {
$message = die('<div id="FightResults"><div class="Fail">Error: You Don\'t Have Enough Money To Set A Bounty On '.$userp['username'].'!</span></div>');
}
if ($cash >= $amount) {
$message = '<div class="Success">Success: After The 10% Fee, You Set A Bounty On '.$userp['username'].'\'s Head For $'.number_format($list_fee).'!</div>';
$update_stats = mysql_query("UPDATE users SET cash=(cash - ".$amount."), stamina=(stamina - 1) WHERE id='".$id."'");
$add_hitlist = mysql_query("INSERT INTO hitlist 
(listed_id, lister_id, amount, timestamp) 
VALUES 
('$listed_id', '$id', '$list_fee', '$timestamp')");
$log_message = '<div id="LogFail">[Hitlist]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Set A $'.number_format($list_fee).' Bounty On Your Head!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$fetchstats','$log_message','$timestamp')");
}
echo '<div id="FightResults" align="center" style="width: 600px; border: 1px solid #FFFFFF; background-color: #333333;">'.$message.'</div>';	
?>
