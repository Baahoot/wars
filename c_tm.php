<?php session_start() ?>
<?php require 'connect.php' ?>
<?php 
if($points < 10) {
	$message = die('<div class="SuccessTMC">Error: You Need 20 Boss Points To Optimize Your TopMob!</div>');
}
$delete = mysql_query("DELETE FROM topmob WHERE owner_id=".$id."");
// Check If You're Mobbed Up
$get_users = mysql_query("select b.id as id, b.username as username, b.income as income from mob a inner join users b on a.sent_id = b.id WHERE a.sender_id=".$id." ORDER BY b.income DESC LIMIT 9");
while($user_info = mysql_fetch_array($get_users)) {
$user_id = $user_info['id'];	
$user_name = $user_info['username'];	
$user_image = $user_info['image'];	
$user_income = $user_info['income'];	
$user_bounty = $user_income * 10;
$user_bonus = (5 / 100) * $user_bounty;
$user_login = $user_info['last_login'];	
$total_bonus += $user_bonus;
// Check Sent
$select_sent = mysql_query("SELECT * FROM topmob_sent WHERE owner_id='".$id."' AND mob_id='".$user_id."'");
// Check Mob
if(mysql_num_rows($get_users) == 0) {
	$message = die('<div class="SuccessTMC">Error: '.$user_name.' Isn\'t In Your Mob!</div>');
}
if(mysql_num_rows($select_sent) == 0) {								  	
	$topmob_send = mysql_query("INSERT INTO topmob_sent (owner_id, mob_id) VALUES ('$id', '$user_id')");
}
$check_tm = mysql_query("SELECT * FROM topmob WHERE owner_id=".$id." AND mob_id=".$user_id."");
if(mysql_num_rows($check_tm) == 1) {
	$message = '<div class="SuccessTMC">Error: '.$user_name.'\'s Already In Your TopMob!</div>';
	$topmob_add = '';	
}	
else {
	$topmob_add = mysql_query("INSERT INTO topmob (owner_id, mob_id) VALUES ('$id', '$user_id')");	
	$message = '<div class="SuccessTMC">Success: '.$user_name.' Promoted To Your Top Mob!</div>';
	$success = 'True';
}
echo $message;
} // While end
if($success == 'True') {
	$update = mysql_query("UPDATE users SET points=(points-10) WHERE id=".$id."");
}
?>
