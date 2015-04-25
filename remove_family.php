<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = strip_tags($_GET['id']);
$timestamp = time();
// API
$file = file_get_contents('http://www.psychowars.net/app/api.php?id='.$user_id.'');
json_decode($file, true);
$v = json_decode($file, true);
$vname = $v['name'];
$vpic = $v['image'];
$vlink = $v['url'];
$vid = $v['id'];
$vlevel = $v['level'];
$vincome = $v['income'];
// API END
// Income Equation
if($vincome < 10000) {
	$vbounty = '10000';
}
else {
	$vbounty = $vincome * 10;
}
// API End	
// Get Users Family Info
$get_info = mysql_query("SELECT * FROM family_members WHERE mob_id=".$user_id."");
while($fam_info = mysql_fetch_array($get_info)) {
$mob_fam_id = $fam_info['family_id'];	
}
// Check If Someone
if(!$id) {
$message = die('<div id="FightResults" align="center"><span class="Fail">Error: You Don\'t Have Access To Do So!</span></div>');	
}
// Check if owner
$check_owner = mysql_query("SELECT * FROM family WHERE owner_id='".$id."' AND id='".$mob_fam_id."'");
if(mysql_num_rows($check_owner) == 0) {
$message = die('<div id="FightResults" align="center"><span class="Fail">Error: You Don\'t Have Access To Do So!</span></div>');	
}	
// Checking if Yourself
if($id == $user_id) {
$message = die('<div id="FightResults" align="center"><span class="Fail">Error: You Can\'t Remove Yourself!</span></div>');	
}
// Check If You're Mobbed Up
$check_mob = mysql_query("SELECT * FROM family_members WHERE mob_id='".$user_id."' AND family_id='".$mob_fam_id."'");
if(mysql_num_rows($check_mob) == 0) {
$message = die('<div id="FightResults" align="center"><span class="Fail">Error: '.$vname.' Isn\'t In Your Family!</span></div>');	
}
else {
	$message = '<span class="Success">Success: You Removed '.$vname.' From Your Family!</span>';
	$delete = mysql_query("DELETE FROM family_members WHERE mob_id='".$user_id."' AND family_id='".$mob_fam_id."'");
}
$res = $delete;
echo '<div id="FightResults" align="center">'.$message.'</div>';
?>
