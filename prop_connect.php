<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$property_id = strip_tags($_GET['id']);
// Check If they own any
$owned_check = mysql_query("SELECT * FROM territory WHERE prop_id='".$property_id."' AND owner_id='".$id."'");
if (mysql_num_rows($owned_check) == 0) {	
$get_stats = mysql_query("SELECT * FROM property_list WHERE id='".$property_id."' LIMIT 1");	
}
else {
$get_stats = mysql_query("SELECT * FROM territory WHERE prop_id='".$property_id."' AND owner_id='".$id."'");	
}
$data = array();
while ( $prop_stats = mysql_fetch_array($get_stats) )
{
  $data[] = $prop_stats; 
}
echo json_encode($data);
?>
