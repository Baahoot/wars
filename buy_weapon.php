<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$weapon_id = strip_tags($_GET['id']);
$weapon_number = strip_tags($_GET['amount']);
$type = mysql_real_escape_string($_GET['type']);
if ( isset ( $weapon_id ) )
{
	$weapon_id = mysql_real_escape_string($weapon_id);
	$sql = "SELECT * FROM all_equipment WHERE id='".$weapon_id."' AND type='".$type."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else {
	}
}
?>
<?php
if($weapon_number < 0) {
	$message = die('<span class="Fail">Error: Fuck Off.</span>');
}
// Weapon Info
$weapon_name = $userp['name'];
$weapon_image = $userp['image'];
$weapon_cost = $userp['cost'];
$weapon_upkeep = $userp['upkeep'];
$weapon_attack = $userp['attack'];
$weapon_defense = $userp['defense'];
$weapon_type = $userp['type'];
$weapon_image = $userp['image'];
$total_cost = $weapon_cost * $weapon_number;
$total_upkeep = $weapon_upkeep * $weapon_number;
// Select Weapons Owned
$weapon_list = mysql_query("SELECT * FROM weapons WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$weapon_type."'");
// They don't Own It Yet
if(mysql_num_rows($weapon_list) == 0) {
if($cash >= $total_cost) {
$message = '<span class="Success">Success: You Purchased '.$weapon_number.' '.$weapon_name.'\'s For $'.number_format($total_cost).'!</span>';	
$buy = mysql_query("INSERT INTO weapons 
			      (owner_id, weapon_id, name, attack, defense, owned, type, image) VALUES 
			      ('$id','$weapon_id','$weapon_name','$weapon_attack','$weapon_defense','$weapon_number','$weapon_type','$weapon_image')");
$update = mysql_query("UPDATE users SET cash=(cash-".$total_cost."),upkeep=(upkeep+".$total_upkeep.") WHERE id='".$id."'");				  	
}
else {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Cash To Purchase '.$weapon_number.' '.$weapon_name.'\'s!</span></div>');	
$buy = '';
$update = '';
	}
}
// They Have Purchased The Weapon Before
elseif(mysql_num_rows($weapon_list) > 0) {
if($cash >= $total_cost) {
$message = '<span class="Success">Success: You Purchased '.$weapon_number.' '.$weapon_name.'\'s For $'.number_format($total_cost).'!</span>';	
$buy = mysql_query("UPDATE weapons SET owned=(owned+".$weapon_number.") WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$weapon_type."'");
$update = mysql_query("UPDATE users SET cash=(cash-".$total_cost."),upkeep=(upkeep+".$total_upkeep.") WHERE id='".$id."'"); 		
}
else {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Cash To Purchase '.$weapon_number.' '.$weapon_name.'\'s!</span></div>');	
$buy = '';
$update = '';	
	}
}
$res = $buy & $update;
echo '<div id="FightResults">'.$message.'</div>';
?>
