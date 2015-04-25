<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$mission_id = strip_tags($_GET['id']);
// Check If they own any
$done_check = mysql_query("SELECT * FROM mission_mastery WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
if (mysql_num_rows($done_check) == 0) {	
$get_stats = mysql_query("SELECT * FROM mastery_list WHERE mission_id='".$mission_id."' LIMIT 1");	
}
else {
$get_stats = mysql_query("SELECT * FROM mission_mastery WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
}
$data = array();
while ( $mastery_stats = mysql_fetch_array($get_stats) )
{
  $data[] = $mastery_stats; 
}
echo json_encode($data);
?>
