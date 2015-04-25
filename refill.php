<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$stat = $_GET['stat'];
if($points < 5) {
$message = die('<span class="Fail">Error: You Don\'t Have Enough Boss Points!</span>');
$update = '';
}
if($stat == 'health' & $health >= $max_health) {
$message = die('<span class="Fail">Error: Your Health\'s Already Full!</span>');
$update = '';
}
if($stat == 'energy' & $energy >= $max_energy) {
$message = die('<span class="Fail">Error: Your Energy\'s Already Full!</span>');
$update = '';
}
if($stat == 'stamina' & $stamina >= $max_stamina) {
$message = die('<span class="Fail">Error: Your Stamina\'s Already Full!</span>');
$update = '';
}
if($stat == 'health') {
$message = '<span class="Success">Success: You Refilled Your Health For 5 Boss Points!</span>';
$update = mysql_query("UPDATE users SET health=".$max_health.",points=(points-5) WHERE id='".$id."'");
}
elseif($stat == 'energy') {
$message = '<span class="Success">Success: You Refilled Your Energy For 5 Boss Points!</span>';
$update = mysql_query("UPDATE users SET energy=".$max_energy.",points=(points-5) WHERE id='".$id."'");
}
elseif($stat == 'stamina') {
$message = '<span class="Success">Success: You Refilled Your Stamina For 5 Boss Points!</span>';
$update = mysql_query("UPDATE users SET stamina=".$max_stamina.",points=(points-5) WHERE id='".$id."'");
}
$res = $update;
echo $message;
