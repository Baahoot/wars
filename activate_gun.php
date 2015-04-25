<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$guns_type = strip_tags(mysql_real_escape_string($_GET['type']));
$guns_id = strip_tags(mysql_real_escape_string($_GET['id']));
// Getting Weapon Info
$get_weapon = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND weapon_id=".$guns_id." AND type='".$guns_type."'");
if(mysql_num_rows($get_weapon) == 0) {
$message = die('<div id="FightResults"><span class="Fail">Erorr: You Don\'t Own This Weapon!</span></div>');	
}
while($weapon = mysql_fetch_array($get_weapon)) {
$weapon_name = $weapon['name'];
$weapon_attack = $weapon['attack'];	
$weapon_defense = $weapon['defense'];
$weapon_owned = $weapon['owned'];	
}
if($guns_type == 'limited') {
$get_type = mysql_query("SELECT * FROM limited_edition WHERE id=".$guns_id."");
while($type = mysql_fetch_array($get_type)) {
$limited_type = $type['gun_type'];	
	}
}
else {
$limited_type = $guns_type;	
}
if($weapon_owned == 0) {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Own This Weapon!</span></div>');
}
// Checking Active Weapons
$get_active = mysql_query("SELECT * FROM active_weapons WHERE owner_id=".$id." AND gun_id=".$guns_id." AND gun_type='".$limited_type."'");
if(mysql_num_rows($get_active) == 0) {
$message = '<span class="Success">Success: '.$weapon_name.' Activated!</span>';
$delete = mysql_query("DELETE FROM active_weapons WHERE owner_id=".$id." AND gun_type='".$limited_type."'");
$insert = mysql_query("INSERT INTO active_weapons 
			          (owner_id,gun_id,gun_name,gun_attack,gun_defense,gun_type) VALUES 
			          ('$id','$guns_id','$weapon_name','$weapon_attack','$weapon_defense','$limited_type')");
$res = $delete & $insert;					  
}
if(mysql_num_rows($get_active) == 1) {
	$message = die('<div id="FightResults"><span class="Fail">Error: '.$weapon_name.' Is Already Equipped!</span></div>');
}
echo '<div id="FightResults">'.$message.'</div>';
?>
