<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$user_id = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $user_id ) )
{
	$user_id = mysql_real_escape_string($user_id);
	$sql = "SELECT * FROM users WHERE id='".$user_id."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else
	{ 
	exit;
	}
}
else
{
	exit;
}
?>
<?php
$race_on = '0';
$timestamp = time();
$exp_calc = (($level/2)+($max_health/10))/2;
$main_exp_calc = $exp_calc/2;
$exp_gain = rand($main_exp_calc,($main_exp_calc+15));
$attacker_percent = $health / $max_health * 100;
$attacked_percent = $userp['health'] / $userp['max_health'] * 100;
// Attackers Weapons
// Attackers Limited
if($level >= 100) {
if($mob_size >=500) {
$a_limited_avail = 500 + $hired_guns; 
}
else {	
$a_limited_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_limited_avail = $level * 5; 
}
else {	
$a_limited_avail = $total_mob;	
	}
}
$check_a_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='limited' AND owned>=".$a_limited_avail." LIMIT 1");
$check_a_lim_info = mysql_fetch_array($check_a_limited);
$a_lim_limit_plus1 = ($check_a_lim_info['id'] + 1);
// Checking limited owned
if(mysql_num_rows($check_a_limited) == 0) {
$a_get_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='limited' AND owned<=".$a_limited_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_limited) == 1) {
$a_get_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='limited' AND owned>=".$a_limited_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_limited = mysql_fetch_array($a_get_limited);
$a_limited_name = $a_limited['name'];
$a_limited_attack = $a_limited['attack'];
$a_limited_owned = $a_limited['owned'];
// Checking Availability
if($a_limited_owned >= $a_limited_avail) {
$a_limited_used = $a_limited_avail;	
}
if($a_limited_owned < $a_limited_avail) {
$a_limited_used = $a_limited_owned;	
}
$a_limited_damage = $a_limited_attack * $a_limited_used;

// Attackers Melee
if($level >= 100) {
if($mob_size >=500) {
$a_melee_avail = 500 + $hired_guns; 
}
else {	
$a_melee_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_melee_avail = $level * 5; 
}
else {	
$a_melee_avail = $total_mob;	
	}
}
$check_a_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='melee' AND owned>=".$a_melee_avail." LIMIT 1");
$check_a_mel_info = mysql_fetch_array($check_a_melee);
$a_mel_limit_plus1 = ($check_a_mel_info['id'] + 1);
// Checking melee owned
if(mysql_num_rows($check_a_melee) == 0) {
$a_get_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='melee' AND owned<=".$a_melee_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_melee) == 1) {
$a_get_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='melee' AND owned>=".$a_melee_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_melee = mysql_fetch_array($a_get_melee);
$a_melee_name = $a_melee['name'];
$a_melee_attack = $a_melee['attack'];
$a_melee_owned = $a_melee['owned'];
// Checking Availability
if($a_melee_owned >= $a_melee_avail) {
$a_melee_used = $a_melee_avail;	
}
if($a_melee_owned < $a_melee_avail) {
$a_melee_used = $a_melee_owned;	
}
$a_melee_damage = $a_melee_attack * $a_melee_used;

// Attackers Gun
if($level >= 100) {
if($mob_size >=500) {
$a_gun_avail = 500 + $hired_guns; 
}
else {	
$a_gun_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_gun_avail = $level * 5; 
}
else {	
$a_gun_avail = $total_mob;	
	}
}
$check_a_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='gun' AND owned>=".$a_gun_avail." LIMIT 1");
$check_a_gun_info = mysql_fetch_array($check_a_gun);
$a_gun_limit_plus1 = ($check_a_gun_info['id'] + 1);
// Checking gun owned
if(mysql_num_rows($check_a_gun) == 0) {
$a_get_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='gun' AND owned<=".$a_gun_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_gun) == 1) {
$a_get_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='gun' AND owned>=".$a_gun_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_gun = mysql_fetch_array($a_get_gun);
$a_gun_name = $a_gun['name'];
$a_gun_attack = $a_gun['attack'];
$a_gun_owned = $a_gun['owned'];
// Checking Availability
if($a_gun_owned >= $a_gun_avail) {
$a_gun_used = $a_gun_avail;	
}
if($a_gun_owned < $a_gun_avail) {
$a_gun_used = $a_gun_owned;	
}
$a_gun_damage = $a_gun_attack * $a_gun_used;

// Attackers Armor
if($level >= 100) {
if($mob_size >=500) {
$a_armor_avail = 500 + $hired_guns; 
}
else {	
$a_armor_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_armor_avail = $level * 5; 
}
else {	
$a_armor_avail = $total_mob;	
	}
}
$check_a_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='armor' AND owned>=".$a_armor_avail." LIMIT 1");
$check_a_armor_info = mysql_fetch_array($check_a_armor);
$a_armor_limit_plus1 = ($check_a_armor_info['id'] + 1);
// Checking armor owned
if(mysql_num_rows($check_a_armor) == 0) {
$a_get_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='armor' AND owned<=".$a_armor_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_armor) == 1) {
$a_get_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='armor' AND owned>=".$a_armor_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_armor = mysql_fetch_array($a_get_armor);
$a_armor_name = $a_armor['name'];
$a_armor_attack = $a_armor['attack'];
$a_armor_owned = $a_armor['owned'];
// Checking Availability
if($a_armor_owned >= $a_armor_avail) {
$a_armor_used = $a_armor_avail;	
}
if($a_armor_owned < $a_armor_avail) {
$a_armor_used = $a_armor_owned;	
}
$a_armor_damage = $a_armor_attack * $a_armor_used;

// Attackers Bombs
if($level >= 100) {
if($mob_size >=500) {
$a_bomb_avail = 500 + $hired_guns; 
}
else {	
$a_bomb_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_bomb_avail = $level * 5; 
}
else {	
$a_bomb_avail = $total_mob;	
	}
}
$check_a_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='bomb' AND owned>=".$a_bomb_avail." LIMIT 1");
$check_a_bomb_info = mysql_fetch_array($check_a_bomb);
$a_bomb_limit_plus1 = ($check_a_bomb_info['id'] + 1);
// Checking bomb owned
if(mysql_num_rows($check_a_bomb) == 0) {
$a_get_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='bomb' AND owned<=".$a_bomb_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_bomb) == 1) {
$a_get_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='bomb' AND owned>=".$a_bomb_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_bomb = mysql_fetch_array($a_get_bomb);
$a_bomb_name = $a_bomb['name'];
$a_bomb_attack = $a_bomb['attack'];
$a_bomb_owned = $a_bomb['owned'];
// Checking Availability
if($a_bomb_owned >= $a_bomb_avail) {
$a_bomb_used = $a_bomb_avail;	
}
if($a_bomb_owned < $a_bomb_avail) {
$a_bomb_used = $a_bomb_owned;	
}
$a_bomb_damage = $a_bomb_attack * $a_bomb_used;

// Attackers Vehicles
if($level >= 100) {
if($mob_size >=500) {
$a_vehicle_avail = 500 + $hired_guns; 
}
else {	
$a_vehicle_avail = $total_mob;	
	}
}
if($level < 100) {
if($mob_size >=500) {
$a_vehicle_avail = $level * 5; 
}
else {	
$a_vehicle_avail = $total_mob;	
	}
}
$check_a_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='vehicle' AND owned>=".$a_vehicle_avail." LIMIT 1");
$check_a_vehicle_info = mysql_fetch_array($check_a_vehicle);
$a_vehicle_limit_plus1 = ($check_a_vehicle_info['id'] + 1);
// Checking vehicle owned
if(mysql_num_rows($check_a_vehicle) == 0) {
$a_get_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='vehicle' AND owned<=".$a_vehicle_avail." ORDER BY attack DESC LIMIT 1");	
}
if(mysql_num_rows($check_a_vehicle) == 1) {
$a_get_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND type='vehicle' AND owned>=".$a_vehicle_avail." ORDER BY attack DESC LIMIT 1");		
}
$a_vehicle = mysql_fetch_array($a_get_vehicle);
$a_vehicle_name = $a_vehicle['name'];
$a_vehicle_attack = $a_vehicle['attack'];
$a_vehicle_owned = $a_vehicle['owned'];
// Checking Availability
if($a_vehicle_owned >= $a_vehicle_avail) {
$a_vehicle_used = $a_vehicle_avail;	
}
if($a_vehicle_owned < $a_vehicle_avail) {
$a_vehicle_used = $a_vehicle_owned;	
}
$a_vehicle_damage = $a_vehicle_attack * $a_vehicle_used;
// Get Total Weapon Damage
$a_total_weapon_damage = (($a_limited_damage + $a_melee_damage + $a_gun_damage + $a_armor_damage + $a_bomb_damage + $a_vehicle_damage) / 10) / 4;
// The user that attacked calculations
$attacker_name = $username;
$attacker_level = $level;
$attacker_attack = $attack;
$attacker_health = $max_health;
$attacker_cash = $cash;
$attacker_equation = (5 / 100) * $attacker_cash;
$attacker_damage = ($attacker_attack + ($attacker_health / 6)) / 2;
$damage_dealt = ($attacker_damage / 2) + $a_total_weapon_damage;
$damage_dealt_r = rand($damage_dealt,($damage_dealt+10));
// Defenders total mob
$d_total_mob = ($userp['mob_size'] + $userp['hired_guns']);
// Defenders Weapons
// Defenders Limited
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_limited_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_limited_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_limited_avail = $userp['level'] * 5; 
}
else {	
$d_limited_avail = $d_total_mob;	
	}
}

$check_d_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='limited' AND owned>=".$d_limited_avail." LIMIT 1");
$check_d_lim_info = mysql_fetch_array($check_d_limited);
$d_lim_limit_plus1 = ($check_d_lim_info['id'] + 1);
// Checking limited owned
if(mysql_num_rows($check_d_limited) == 0) {
$d_get_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='limited' AND owned<=".$d_limited_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_limited) == 1) {
$d_get_limited = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='limited' AND owned>=".$d_limited_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_limited = mysql_fetch_array($d_get_limited);
$d_limited_name = $d_limited['name'];
$d_limited_defense = $d_limited['defense'];
$d_limited_owned = $d_limited['owned'];
// Checking Availability
if($d_limited_owned >= $d_limited_avail) {
$d_limited_used = $d_limited_avail;	
}
if($d_limited_owned < $d_limited_avail) {
$d_limited_used = $d_limited_owned;	
}
$d_limited_damage = $d_limited_defense * $d_limited_used;

// Defenders Melee
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_melee_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_melee_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_melee_avail = $userp['level'] * 5; 
}
else {	
$d_melee_avail = $d_total_mob;	
	}
}
$check_d_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='melee' AND owned>=".$d_melee_avail." LIMIT 1");
$check_d_mel_info = mysql_fetch_array($check_d_melee);
$d_mel_limit_plus1 = ($check_d_mel_info['id'] + 1);
// Checking melee owned
if(mysql_num_rows($check_d_melee) == 0) {
$d_get_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='melee' AND owned<=".$d_melee_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_melee) == 1) {
$d_get_melee = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='melee' AND owned>=".$d_melee_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_melee = mysql_fetch_array($d_get_melee);
$d_melee_name = $d_melee['name'];
$d_melee_defense = $d_melee['defense'];
$d_melee_owned = $d_melee['owned'];
// Checking Availability
if($d_melee_owned >= $d_melee_avail) {
$d_melee_used = $d_melee_avail;	
}
if($d_melee_owned < $d_melee_avail) {
$d_melee_used = $d_melee_owned;	
}
$d_melee_damage = $d_melee_defense * $d_melee_used;

// Defenders Gun
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_gun_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_gun_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_gun_avail = $userp['level'] * 5; 
}
else {	
$d_gun_avail = $d_total_mob;	
	}
}
$check_d_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='gun' AND owned>=".$d_gun_avail." LIMIT 1");
$check_d_gun_info = mysql_fetch_array($check_d_gun);
$d_gun_limit_plus1 = ($check_d_gun_info['id'] + 1);
// Checking gun owned
if(mysql_num_rows($check_d_gun) == 0) {
$d_get_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='gun' AND owned<=".$d_gun_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_gun) == 1) {
$d_get_gun = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='gun' AND owned>=".$d_gun_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_gun = mysql_fetch_array($d_get_gun);
$d_gun_name = $d_gun['name'];
$d_gun_defense = $d_gun['defense'];
$d_gun_owned = $d_gun['owned'];
// Checking Availability
if($d_gun_owned >= $d_gun_avail) {
$d_gun_used = $d_gun_avail;	
}
if($d_gun_owned < $d_gun_avail) {
$d_gun_used = $d_gun_owned;	
}
$d_gun_damage = $d_gun_defense * $d_gun_used;

// Defenders Armor
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_armor_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_armor_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_armor_avail = $userp['level'] * 5; 
}
else {	
$d_armor_avail = $d_total_mob;	
	}
}
$check_d_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='armor' AND owned>=".$d_armor_avail." LIMIT 1");
$check_d_armor_info = mysql_fetch_array($check_d_armor);
$d_armor_limit_plus1 = ($check_d_armor_info['id'] + 1);
// Checking armor owned
if(mysql_num_rows($check_d_armor) == 0) {
$d_get_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='armor' AND owned<=".$d_armor_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_armor) == 1) {
$d_get_armor = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='armor' AND owned>=".$d_armor_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_armor = mysql_fetch_array($d_get_armor);
$d_armor_name = $d_armor['name'];
$d_armor_defense = $d_armor['defense'];
$d_armor_owned = $d_armor['owned'];
// Checking Availability
if($d_armor_owned >= $d_armor_avail) {
$d_armor_used = $d_armor_avail;	
}
if($d_armor_owned < $d_armor_avail) {
$d_armor_used = $d_armor_owned;	
}
$d_armor_damage = $d_armor_defense * $d_armor_used;

// Defenders Bombs
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_bomb_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_bomb_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_bomb_avail = $userp['level'] * 5; 
}
else {	
$d_bomb_avail = $d_total_mob;	
	}
}
$check_d_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='bomb' AND owned>=".$d_bomb_avail." LIMIT 1");
$check_d_bomb_info = mysql_fetch_array($check_d_bomb);
$d_bomb_limit_plus1 = ($check_d_bomb_info['id'] + 1);
// Checking bomb owned
if(mysql_num_rows($check_d_bomb) == 0) {
$d_get_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='bomb' AND owned<=".$d_bomb_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_bomb) == 1) {
$d_get_bomb = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='bomb' AND owned>=".$d_bomb_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_bomb = mysql_fetch_array($d_get_bomb);
$d_bomb_name = $d_bomb['name'];
$d_bomb_defense = $d_bomb['defense'];
$d_bomb_owned = $d_bomb['owned'];
// Checking Availability
if($d_bomb_owned < $d_bomb_avail) {
$d_bomb_used = $d_bomb_avail;	
}
if($d_bomb_owned >= $d_bomb_avail) {
$d_bomb_used = $d_bomb_owned;	
}
if($d_bomb_avail > $d_total_mob) {
$d_bomb_used = $d_total_mob;	
}
$d_bomb_damage = $d_bomb_defense * $d_bomb_used;

// Defenders Vehicles
if($userp['level'] >= 100) {
if($userp['mob_size'] >=500) {
$d_vehicle_avail = 500 + $userp['hired_guns']; 
}
else {	
$d_vehicle_avail = $d_total_mob;	
	}
}
if($userp['level'] < 100) {
if($userp['mob_size'] >=500) {
$d_vehicle_avail = $userp['level'] * 5; 
}
else {	
$d_vehicle_avail = $d_total_mob;	
	}
}
$check_d_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='vehicle' AND owned>=".$d_vehicle_avail." LIMIT 1");
$check_d_vehicle_info = mysql_fetch_array($check_d_vehicle);
$d_vehicle_limit_plus1 = ($check_d_vehicle_info['id'] + 1);
// Checking vehicle owned
if(mysql_num_rows($check_d_vehicle) == 0) {
$d_get_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='vehicle' AND owned<=".$d_vehicle_avail." ORDER BY defense DESC LIMIT 1");	
}
if(mysql_num_rows($check_d_vehicle) == 1) {
$d_get_vehicle = mysql_query("SELECT * FROM weapons WHERE owner_id=".$userp['id']." AND type='vehicle' AND owned>=".$d_vehicle_avail." ORDER BY defense DESC LIMIT 1");		
}
$d_vehicle = mysql_fetch_array($d_get_vehicle);
$d_vehicle_name = $d_vehicle['name'];
$d_vehicle_defense = $d_vehicle['defense'];
$d_vehicle_owned = $d_vehicle['owned'];
// Checking Availability
if($d_vehicle_owned >= $d_vehicle_avail) {
$d_vehicle_used = $d_vehicle_avail;	
}
if($d_vehicle_owned < $d_vehicle_avail) {
$d_vehicle_used = $d_vehicle_owned;	
}
$d_vehicle_damage = $d_vehicle_defense * $d_vehicle_used;
// Get Total Weapon Damage
$d_total_weapon_damage = (($d_limited_damage + $d_melee_damage + $d_gun_damage + $d_armor_damage + $d_bomb_damage + $d_vehicle_damage) / 10) / 4;
// The user that was attacked calculations
$attacked_name = $userp['username'];
$attacked_level = $userp['level'];
$attacked_defense = $userp['defense'];
$attacked_health = $userp['max_health'];
$attacked_cash = $userp['cash'];
$attacked_equation = (5 / 100) * $attacked_cash;
$attacked_damage = ($attacked_defense + ($attacked_health / 6)) / 2;
$damage_taken = ($attacked_damage / 2) + $d_total_weapon_damage;
$damage_taken_r = rand($damage_taken,($damage_taken+10));
// See if they're on the hitlist
$hitlist_check = mysql_query("SELECT * FROM hitlist WHERE listed_id='".$user_id."' LIMIT 1"); 
if (mysql_num_rows($hitlist_check) == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: '.$userp['username'].'\'s Bounty Has Already Been Claimed!</span></div>');
}
// Select User From Hitlist
$hitlist_users = mysql_query("SELECT * FROM hitlist WHERE listed_id='".$user_id."' LIMIT 1");
while($hitlist = mysql_fetch_array($hitlist_users)) {
$lister_id = $hitlist['lister_id'];
$hitlist_amount = $hitlist['amount'];
// Results
if ($userp['id'] == $id) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Can\'t Attack Yourself!</span></div>');
}
if($stamina < 1) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Stamina To Attack '.$attacked_name.'!</span></div>');
}
if($attacker_percent < 25) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Need To Heal Before Attacking '.$attacked_name.'!</span></div>');
}
if(($damage_dealt_r) > ($damage_taken_r)) {
$fight_image = 'FightWon';
$fight_result = '<span class="Success">You Won!</span>';
$message = 'You Attacked '.$attacked_name.'! You Dealt '.number_format($damage_dealt_r).' Damage, While Taking '.number_format($damage_taken_r).' Damage! <div id="FightEXP"><div id="FightEXP">You Gained '.number_format($exp_gain).' EXP!</div></div>';
$again = 
'<div align="center" style="color: #0FF; font-weight: bold; cursor: pointer;" onclick="AttackHitlist('.$userp['id'].')">Attack Again</div>';
$attacker_query = mysql_query("UPDATE users SET health=(health-".$damage_taken_r."),wins=(wins+1),stamina=(stamina-1),exp=(exp+".$exp_gain.") WHERE id='".$id."'");
$attacked_query = mysql_query("UPDATE users SET health=(health-".$damage_dealt_r."),loses=(loses+1) WHERE id='".$user_id."'");
$log_message = '<div id="LogFail">[Hitlist | You Lost]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id, messages, timestamp)VALUES('$user_id','$log_message','$timestamp')");
// If You killed them
if($userp['health'] - $damage_dealt_r <= 0) {
	$killed = '<span id="FightKill">You Killed '.$attacked_name.'! You Received A Bounty Of $'.number_format($hitlist['amount']).'!</span>';
	$kill_query1 = mysql_query("UPDATE users SET kills=(kills+1),bounties=(bounties+1),cash=(cash+".$hitlist['amount'].") WHERE id='".$id."'");
	$kill_query2 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$userp['id']."'");
	$delete = mysql_query("DELETE FROM hitlist WHERE listed_id='".$user_id."'");
	$log_message = '<div id="LogFail">[Hitlist | You Lost]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage! You Died! '.$username.' Recieved A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$user_id','$log_message','$timestamp')");
	$log_message1 = '<div id="LogSuccess">[Hitlist | Killed]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Killed <span id="LogName" onClick="ViewUser('.$userp['id'].')">'.$userp['username'].'</span> Recieving A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter1 = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$lister_id','$log_message1','$timestamp')");
	$again = '';
	// Competition
	if($race_on == '1') {
	$select_race = mysql_query("SELECT * FROM hitlist_race WHERE owner_id='".$id."'");
	if(mysql_num_rows($select_race) == 0) {
	$enter_race = mysql_query("INSERT INTO hitlist_race (owner_id,bounties) VALUES ('$id',1)");
	}
	else {
	$enter_race = mysql_query("UPDATE hitlist_race SET bounties=(bounties+1) WHERE owner_id=".$id."");
		}
	}
	elseif($race_on == '0') {
	
	}	
}
else {
	$killed = '';
	$kill_query1 = '';
	$kill_query2 = '';	
	$delete = '';
	$log_enter = '';
	$log_enter1 = '';
	$log_message = '';
	$log_message1 = '';
}
if($health - $damage_taken_r <= 0) {
	$died = '<span id="FightKill">You Died!</span>';
	$death_query1 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$id."'");
	$death_query2 = mysql_query("UPDATE users SET kills=(kills+1) WHERE id='".$userp['id']."'");
}
else {
	$died = '';
	$death_query1 = '';
	$death_query2 = '';	
}	
$res = $attacker_query & $attacked_query & $kill_query1 & $kill_query2 & $death_query1 & $death_query2 & $delete & $log_enter & $log_enter1; 		
}
if(($damage_dealt_r) == ($damage_taken_r)) {
$fight_image = 'FightWon';
$fight_result = '<span class="Success">You Won!</span>';
$message = 'You Attacked '.$attacked_name.'! You Dealt '.number_format($damage_dealt_r+rand(3,5)).' Damage, While Taking '.number_format($damage_taken_r).' Damage! <div id="FightEXP">You Gained '.number_format($exp_gain).' EXP!</div>';
$again = 
'<div align="center" style="color: #0FF; font-weight: bold; cursor: pointer;" onclick="AttackHitlist('.$userp['id'].')">Attack Again</div>';
$attacker_query = mysql_query("UPDATE users SET health=(health-".$damage_taken_r."),wins=(wins+1),stamina=(stamina-1),exp=(exp+".$exp_gain.") WHERE id='".$id."'");
$attacked_query = mysql_query("UPDATE users SET health=(health-".($damage_dealt_r+rand(3,5))."),loses=(loses+1) WHERE id='".$user_id."'");
$log_message = '<div id="LogFail">[Hitlist | You Lost]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id, messages, timestamp)VALUES('$user_id','$log_message','$timestamp')");
// If You killed them
if($userp['health'] - $damage_dealt_r <= 0) {
	$killed = '<span id="FightKill">You Killed '.$attacked_name.'! You Received A Bounty Of $'.number_format($hitlist['amount']).'!</span>';
	$kill_query1 = mysql_query("UPDATE users SET kills=(kills+1),bounties=(bounties+1),cash=(cash+".$hitlist['amount'].") WHERE id='".$id."'");
	$kill_query2 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$userp['id']."'");
	$delete = mysql_query("DELETE FROM hitlist WHERE listed_id='".$user_id."'");
	$log_message = '<div id="LogFail">[Hitlist | You Lost]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage! You Died! '.$username.' Recieved A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$user_id','$log_message','$timestamp')");
	$log_message1 = '<div id="LogSuccess">[Hitlist | Killed]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Killed <span id="LogName" onClick="ViewUser('.$userp['id'].')">'.$userp['username'].'</span> Recieving A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter1 = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$lister_id','$log_message1','$timestamp')");	
	$again = '';
	// Competition
	if($race_on == '1') {
	$select_race = mysql_query("SELECT * FROM hitlist_race WHERE owner_id='".$id."'");
	if(mysql_num_rows($select_race) == 0) {
	$enter_race = mysql_query("INSERT INTO hitlist_race (owner_id,bounties) VALUES ('$id',1)");
	}
	else {
	$enter_race = mysql_query("UPDATE hitlist_race SET bounties=(bounties+1) WHERE owner_id=".$id."");
		}
	}
	elseif($race_on == '0') {
	
	}
}
else {
	$killed = '';
	$kill_query1 = '';
	$kill_query2 = '';	
	$delete = '';
	$log_enter = '';
	$log_enter1 = '';
	$log_message = '';
	$log_message1 = '';
}
if($health - $damage_taken_r <= 0) {
	$died = '<span id="FightKill">You Died!</span>';
	$death_query1 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$id."'");
	$death_query2 = mysql_query("UPDATE users SET kills=(kills+1) WHERE id='".$userp['id']."'");
}
else {
	$died = '';
	$death_query1 = '';
	$death_query2 = '';	
}		
$res = $attacker_query & $attacked_query & $kill_query1 & $kill_query2 & $death_query1 & $death_query2 & $delete & $log_enter & $log_enter1; 		
}
if(($damage_dealt_r) < ($damage_taken_r)) {
$fight_image = 'FightLost';
$fight_result = '<span class="Fail">You Lost!</span>';
$message = 'You Attacked '.$attacked_name.'! You Dealt '.number_format($damage_dealt_r).' Damage, While Taking '.number_format($damage_taken_r).' Damage!';
$again = 
'<div align="center" style="color: #0FF; font-weight: bold; cursor: pointer;" onclick="AttackHitlist('.$userp['id'].')">Attack Again</div>';
$attacker_query = mysql_query("UPDATE users SET health=(health-".$damage_taken_r."),loses=(loses+1),stamina=(stamina-1) WHERE id='".$id."'");
$attacked_query = mysql_query("UPDATE users SET health=(health-".$damage_dealt_r."),wins=(wins+1),exp=(exp+".$exp_gain.") WHERE id='".$user_id."'");
$log_message = '<div id="LogSuccess">[Hitlist | You Won]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage!</div>';
$log_enter = mysql_query("INSERT INTO fight_log(owner_id, messages, timestamp)VALUES('$user_id','$log_message','$timestamp')");
// If You killed them
if($userp['health'] - $damage_dealt_r <= 0) {
	$killed = '<span id="FightKill">You Killed '.$attacked_name.'! You Received A Bounty Of $'.number_format($hitlist['amount']).'!</span>';
	$kill_query1 = mysql_query("UPDATE users SET kills=(kills+1),bounties=(bounties+1),cash=(cash+".$hitlist['amount'].") WHERE id='".$id."'");
	$kill_query2 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$userp['id']."'");
	$delete = mysql_query("DELETE FROM hitlist WHERE listed_id='".$user_id."'");
	$log_message = '<div id="LogSuccess">[Hitlist | You Won]</div> <div id="LogResult">You Were Attacked By <span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Dealing '.number_format($damage_taken_r).' Damage While Taking '.number_format($damage_dealt_r).' Damage! You Died! '.$username.' Recieved A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$user_id','$log_message','$timestamp')");
	$log_message1 = '<div id="LogSuccess">[Hitlist | Killed]</div> <div id="LogResult"><span id="LogName" onClick="ViewUser('.$id.')">'.$username.'</span> Killed <span id="LogName" onClick="ViewUser('.$userp['id'].')">'.$userp['username'].'</span> Recieving A Reward of $'.number_format($hitlist['amount']).'!</div>';
	$log_enter1 = mysql_query("INSERT INTO fight_log(owner_id,messages,timestamp)VALUES('$lister_id','$log_message1','$timestamp')");
	$again = '';
	// Competition
	if($race_on == '1') {
	$select_race = mysql_query("SELECT * FROM hitlist_race WHERE owner_id='".$id."'");
	if(mysql_num_rows($select_race) == 0) {
	$enter_race = mysql_query("INSERT INTO hitlist_race (owner_id,bounties) VALUES ('$id',1)");
	}
	else {
	$enter_race = mysql_query("UPDATE hitlist_race SET bounties=(bounties+1) WHERE owner_id=".$id."");
		}
	}
	elseif($race_on == '0') {
	
	}
}
else {
	$killed = '';
	$kill_query1 = '';
	$kill_query2 = '';	
	$delete = '';
	$log_enter = '';
	$log_enter1 = '';
	$log_message = '';
	$log_message1 = '';
}
if($health - $damage_taken_r <= 0) {
	$died = '<span id="FightKill">You Died!</span>';
	$death_query1 = mysql_query("UPDATE users SET deaths=(deaths+1),health=0 WHERE id='".$id."'");
	$death_query2 = mysql_query("UPDATE users SET kills=(kills+1) WHERE id='".$userp['id']."'");
}
else {
	$died = '';
	$death_query1 = '';
	$death_query2 = '';	
}	
$res = $attacker_query & $attacked_query & $kill_query1 & $kill_query2 & $death_query1 & $death_query2 & $delete & $log_enter & $log_enter1; 	
	}
}
echo 
'<div id="FightResults">
<table width="600" align="center" style="border-bottom: 1px dotted #FFFFFF;">
  <tr>
    <td align="center" width="200" valign="middle">
    <div id="FightUser">'.$attacker_name.'</div>
    <div><img src="'.$image.'" width="50" height="50" /></div>
    </td>
    <td align="center" width="200"><img src="images/'.$fight_image.'.png" /></td>
    <td align="center" width="200" valign="middle">
    <div id="FightUser">'.$attacked_name.'</div>
    <div><img src="'.$userp['image'].'" width="50" height="50" /></div>    
    </td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top">
    <span id="WeaponUser">You Used '.mysql_num_rows($att_weapons).' Activated Weapons: </span> 
	<span id="WeaponsUsed">';
	// Limited
	if($a_limited_owned > '0'){
	echo $a_limited_used.' '.$a_limited_name.'\'s, ';
	}
	elseif(!$a_limited_owned){
	echo '';
	}
	// Melee
	if($a_melee_owned > '0'){
	echo $a_melee_used.' '.$a_melee_name.'\'s, ';
	}
	elseif(!$a_melee_owned){
	echo '';
	}
	// Gun
	if($a_gun_owned > '0'){
	echo $a_gun_used.' '.$a_gun_name.'\'s, ';
	}
	elseif(!$a_gun_owned){
	echo '';
	}
	// Armor
	if($a_armor_owned > '0'){
	echo $a_armor_used.' '.$a_armor_name.'\'s, ';
	}
	elseif(!$a_armor_owned){
	echo '';
	}
	// Bomb
	if($a_bomb_owned > '0'){
	echo $a_bomb_used.' '.$a_bomb_name.'\'s, ';
	}
	elseif(!$a_bomb_owned){
	echo '';
	}
	// Vehicle
	if($a_vehicle_owned > '0'){
	echo $a_vehicle_used.' '.$a_vehicle_name.'\'s, ';
	}
	elseif(!$a_vehicle_owned){
	echo '';
	}
	echo '</span>
	<br />
    <span id="WeaponUser">'.$userp['username'].' Used: </span> 
	<span id="WeaponsUsed">';
	// Limited
	if($d_limited_owned > '0'){
	echo $d_limited_used.' '.$d_limited_name.'\'s, ';
	}
	elseif(!$d_limited_owned){
	echo '';
	}
	// Melee
	if($d_melee_owned > '0'){
	echo $d_melee_used.' '.$d_melee_name.'\'s, ';
	}
	elseif(!$d_melee_owned){
	echo '';
	}
	// Gun
	if($d_gun_owned > '0'){
	echo $d_gun_used.' '.$d_gun_name.'\'s, ';
	}
	elseif(!$d_gun_owned){
	echo '';
	}
	// Armor
	if($d_armor_owned > '0'){
	echo $d_armor_used.' '.$d_armor_name.'\'s, ';
	}
	elseif(!$d_armor_owned){
	echo '';
	}
	// Bomb
	if($d_bomb_owned > '0'){
	echo $d_bomb_used.' '.$d_bomb_name.'\'s, ';
	}
	elseif(!$d_bomb_owned){
	echo '';
	}
	// Vehicle
	if($d_vehicle_owned > '0'){
	echo $d_vehicle_used.' '.$d_vehicle_name.'\'s, ';
	}
	elseif(!$d_vehicle_owned){
	echo '';
	}
	echo '</span>
    </td>
  </tr>
</table>
<div id="FightMessage">'.$message.'</div>'.$killed.$died.$again.'</div>';
echo $check_comp;
?>
