<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
// Get Button Information
$weapon_id = strip_tags($_GET['id']);
$weapon_number = strip_tags($_GET['amount']);
$type = mysql_real_escape_string($_GET['type']);
// Can't Sell Negative Amount
if($weapon_number < 0) {
	$message = die('<span class="Fail">Error: Fuck Off.</span>');
}
// Weapon Info
$weapon_info = mysql_query("SELECT * FROM all_equipment WHERE id='".$weapon_id."'");
while($info = mysql_fetch_array($weapon_info)) {
$info_name = $info['name'];
$info_cost = $info['cost'];
$info_sell = $info['sell'];
$info_type = $info['type'];
$sale_price = ($info_cost/2)*$weapon_number;
}
// Get users weapons
$get_weapons = mysql_query("SELECT * FROM weapons WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$info_type."'");
while($weapon = mysql_fetch_array($get_weapons)) {
$weapon_name = $weapon['name'];
$weapon_owned = $weapon['owned'];
}
if(mysql_num_rows($get_weapons) == 0) {
	$weapons_name = $info_name;
}
else {
	$weapons_name = $weapon_name;
}
// Check Active Weapons
$get_active = mysql_query("SELECT * FROM active_weapons WHERE owner_id='".$id."' AND gun_id='".$weapon_id."' AND gun_type='".$info_type."'");
if(mysql_num_rows($get_active) == 1) {
$message = die('<div class="Fail">Error: Deactivate '.$weapons_name.' First!');
}
if($weapon_owned < $weapon_number) {
$message = die('<div class="Fail">Error: You Don\'t Own '.number_format($weapon_number).' '.$weapons_name.'\'s!');
}
if($info_sell == 'No') {
$message = die('<div class="Fail">Error: You Can\'t Sell '.$weapons_name.'\'s!');
}
else {
$message = '<div class="Success">Success: You Sold '.number_format($weapon_number).' '.$weapon_name.'\'s For $'.number_format($sale_price).'!';
$update_weapons = mysql_query("UPDATE weapons SET owned=(owned-".$weapon_number.") WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$info_type."'");
$update_stats = mysql_query("UPDATE users SET cash=(cash+".(int)$sale_price.") WHERE id=".$id."");
}
echo $message;
?>
