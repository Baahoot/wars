<?php session_start ?>
<?php require 'connect.php' ?>
<?php
$buy_option = strip_tags($_GET['id']);
if($buy_option == 1) {
$cost = '15';
$name = 'Hired Gun';
$query_name = 'hired_guns';	
}
if($buy_option == 2) {
$cost = '20';
$name = 'Pair Of Brass Knuckles';
$query_name = 'knuckles';	
}
if($points < $cost) {
$message = die('<span class="Fail">Error: You Need At Least '.$cost.' Boss Points For 1 '.$name.'!</span>');
}
else {
$message = '<span class="Success">Success: You Purchased 1 '.$name.' For '.$cost.'!</span>';
$update = mysql_query("UPDATE users SET ".$query_name."=(".$query_name."+1),points=(points-".$cost.") WHERE id=".$id."");	
}
echo $message;
?>
