<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$boss_id = strip_tags($_GET['id']);
// Check If they own any
$get_stats = mysql_query("SELECT * FROM  boss_fight WHERE owner_id='".$id."' AND boss_id='".$boss_id."'");
$data = array();
while ( $boss_stats = mysql_fetch_array($get_stats) )
{
  $data[] = $boss_stats; 
}
echo json_encode($data);
?>
