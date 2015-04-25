<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){die('<meta HTTP-EQUIV="REFRESH" content="0; url=index.php">');} ?>
<?php
$get_stats = mysql_query("SELECT * FROM users WHERE id='".$id."' LIMIT 1");	
$data = array();
while ( $user_stats = mysql_fetch_array($get_stats) )
{
  $data[] = $user_stats;
  $data['sess'] = session_id(); 
}
echo json_encode($data);
?>
<?php 
$exp_percent = $max_exp/10;
if($exp >= $max_exp) {
$update = mysql_query("UPDATE users SET level=(level + 1),exp='0',max_exp=(max_exp + ".$exp_percent."),skill_points=(skill_points+3),heal_cost=(heal_cost+50) WHERE id='".$id."'");
$res = $update;
}
else {
	$update = '';
}
?>
