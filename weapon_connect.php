<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$weapon_id = strip_tags($_GET['id']);
$type = strip_tags($_GET['type']);
// Check If they own any
$get_stats = mysql_query("SELECT * FROM weapons WHERE weapon_id='".$weapon_id."' AND type='".$type."' AND owner_id='".$id."'");
if(mysql_num_rows($get_stats) == 0) {
	die('0');
}
else {
	
}
$data = array();
while ( $weapon_stats = mysql_fetch_array($get_stats) )
{
  $data[] = $weapon_stats; 
}
echo json_encode($data);
?>
