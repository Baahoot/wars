<?php session_start() ?>
<?php require 'connect.php' ?>
<br/>
<?php
// Healing Info
$heal_plus = rand(10,35);
$percent = $health / $max_health * 100;
$heal_chance = rand(1,2);
// Checking Health and bank cash
if($percent > 65) {
$message = die('<div class="Fail">Error: You Can\'t Heal Past 65%!</div>');
}
if($bank < $heal_cost) {
$message = die('<div class="Fail">Error: You Don\'t Have Enough Cash In The Bank To Heal!</div>');
}
// Getting Ambulances
$get_ambulances = mysql_query("SELECT * FROM weapons WHERE weapon_id='7' AND owner_id='".$id."' AND type='inventory' AND owned>0");
// Have ambulances
if(mysql_num_rows($get_ambulances) > 0) {
// Chances	
if($heal_chance == 1) {	
$message = '<div class="Success">Success: You Healed, Gaining '.$heal_plus.' Health!</div>';
$heal = mysql_query("UPDATE users SET health=(health + '".$heal_plus."'), bank=(bank - ".$heal_cost.") WHERE id='".$id."'");
}
if($heal_chance == 2) {
$message = '<div class="Success">Success: You Used 1 Ambulance! You Were Fully Healed To '.number_format($max_health).' Health!</div>';
$heal = mysql_query("UPDATE users SET health='".$max_health."' WHERE id='".$id."'");
$update = mysql_query("UPDATE weapons SET owned=(owned-1) WHERE weapon_id='1' AND owner_id='".$id."' AND type='inventory'");	
	}
}
// Have no ambulances
if(mysql_num_rows($get_ambulances) == 0) {
// Chances
if($heal_chance == 1) {	
$message = '<div class="Success">Success: You Healed, Gaining '.$heal_plus.' Health!</div>';
$heal = mysql_query("UPDATE users SET health=(health + '".$heal_plus."'), bank=(bank - ".$heal_cost.") WHERE id='".$id."'");
}
if($heal_chance == 2) {	
$message = '<div class="Success">Success: You Healed, Gaining '.$heal_plus.' Health!</div>';
$heal = mysql_query("UPDATE users SET health=(health + '".$heal_plus."'), bank=(bank - ".$heal_cost.") WHERE id='".$id."'");
	}
}
echo $message;
?>
