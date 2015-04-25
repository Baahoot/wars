<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$att = strip_tags($_GET['att']);
if($skills == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Skill Points!</span></div>');
}
else {
if($att == 'attack') {
$message = '<span class="Success">Success: You Increased Your Attack By 1!</span>';
$increase = mysql_query("UPDATE users SET attack=(attack + 1),skill_points=(skill_points-1) WHERE id='".$id."'");
}
if($att == 'defense') {
$message = '<span class="Success">Success: You Increased Your Defense By 1!</span>';
$increase = mysql_query("UPDATE users SET defense=(defense + 1),skill_points=(skill_points-1) WHERE id='".$id."'");
}
if($att == 'max_health') {
$message = '<span class="Success">Success: You Increased Your Max Health By 10!</span>';
$increase = mysql_query("UPDATE users SET max_health=(max_health + 10),skill_points=(skill_points-1) WHERE id='".$id."'");
}
if($att == 'max_energy') {
$message = '<span class="Success">Success: You Increased Your Max Energy By 10!</span>';
$increase = mysql_query("UPDATE users SET max_energy=(max_energy + 10),skill_points=(skill_points-1) WHERE id='".$id."'");
}
if($att == 'max_stamina') {
$message = '<span class="Success">Success: You Increased Your Max Stamina By 1!</span>';
$increase = mysql_query("UPDATE users SET max_stamina=(max_stamina + 1),skill_points=(skill_points-2) WHERE id='".$id."'");
	}
}
$res = $increase;
echo $message;
?>
