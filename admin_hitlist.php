<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<?php
$count = 1;
$number = (int)($_GET['number']);
// Select the users
$select_users = mysql_query("SELECT * FROM users ORDER BY RAND() LIMIT ".$number."");
while ($listed = mysql_fetch_array($select_users)) {
$listed_id = $listed['id'];
$listed_name = $listed['username'];
$listed_bounty = $listed['income'] * 10;
$listed_m_health = $listed['max_health'];
$listed_image = $listed['image'];
$lister_id = '1';
$lister_name = 'Admin';
$timestamp = time();
$list_feee = (10 / 100) * $listed_bounty;
$list_fee = $listed_bounty - $list_feee;
// Check Hitlist
$check_hitlist = mysql_query("SELECT * FROM hitlist WHERE listed_id=".$listed_id."");
// User Can't Be Listed
if(mysql_num_rows($check_hitlist) > 0) {
	$message = die('<div id="AdminHitlist"><span class="Fail">'.$listed_name.'\'s Already On The Hitlist!</span></div>');
	$res = die();
	$insert_bc = die();
}
// User Can Be Listed
elseif(mysql_num_rows == 0) {
$update_user = mysql_query("UPDATE users SET health='".$listed_m_health."' WHERE id=".$listed_id."");
$hitlist_user = mysql_query("INSERT INTO hitlist 
	(listed_id, lister_id,amount,timestamp) VALUES 
	('$listed_id','$lister_id','$list_fee','$timestamp')");
$log_message = '<div id="LogFail">[Hitlist]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$lister_id.')">'.$lister_name.'</span> Set A $'.number_format($listed_bounty).' Bounty On Your Head!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$listed_id','$log_message','$timestamp')");	
$message = '<span class="Success">'.$count++.'. You Added '.$listed_name.' To The Hitlist For $'.number_format($list_fee).'!<br /></span>';
$res = $update_user & $hitlist_user & $log_enter;
}
echo '<div id="AdminHitlist">'.$message.'</div>';	
}
?>
