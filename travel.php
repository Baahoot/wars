<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$travel_id = strip_tags($_GET['id']);
$locations = mysql_query("SELECT * FROM locations WHERE id='".$travel_id."'");
while($loc_info = mysql_fetch_array($locations)) {
$loc_name = $loc_info['name'];		
$loc_cost = $loc_info['cost'];
$loc_level = $loc_info['level'];
}
if($loc_name == $location) {
$message = die('<span class="Fail">Error: You\'re Already In '.$location.'!</span>');
$update = '';
}
if($cash < $loc_cost) {
$message = die('<span class="Fail">Error: You Don\'t Have $'.number_format($loc_cost).' To Travel To '.$loc_name.'!</span>');
$update = '';
}
if($level < $loc_level) {
$message = die('<span class="Fail">Error: You Must Be Level '.$loc_level.' To Travel To '.$loc_name.'!</span>');
$update = '';
}
if(time() >= $travel_time) {
$time_add = strtotime('+15 minutes',time());	
$message = '<span class="Success">Success: You Traveled To '.$loc_name.' Paying A $'.number_format($loc_cost).' Flight Fee!</span>';	
$update = mysql_query("UPDATE users SET location='".$loc_name."',travel='".$time_add."',cash=(cash-".$loc_cost.") WHERE id='".$id."'");
}
$res = $update;
echo $message;
?>
