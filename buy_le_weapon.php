<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$weapon_id = strip_tags($_GET['id']);
$weapon_number = strip_tags($_GET['amount']);
$type = mysql_real_escape_string($_GET['type']);
if ( isset ( $weapon_id ) )
{
	$weapon_id = mysql_real_escape_string($weapon_id);
	$sql = "SELECT * FROM limited_edition WHERE id='".$weapon_id."' LIMIT 1";
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
$check_amount = mysql_query("SELECT * FROM limited_edition WHERE id=".$weapon_id."");
while($amount = mysql_fetch_array($check_amount)) {
$amount_avail = $amount['amount'];	
}
if($amount_avail - $weapon_number < 0) {
	$message = die('<span class="Fail">Error: Not Enough Availabilty!</span>');	
}
// Weapon Info
$weapon_name = $userp['name'];
$weapon_image = $userp['image'];
$weapon_cost = $userp['cost'];
$weapon_attack = $userp['attack'];
$weapon_defense = $userp['defense'];
$weapon_type = $userp['type'];
$weapon_gun_type = $userp['gun_type'];
$weapon_amount = $userp['amount'];
$total_cost = $weapon_cost * $weapon_number;
// Select Weapons Owned
$weapon_list = mysql_query("SELECT * FROM weapons WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$weapon_type."'");
// They don't Own It Yet
if(mysql_num_rows($weapon_list) == 0) {
if($points >= $total_cost) {
$message = '<span class="Success">Success: You Purchased '.$weapon_number.' '.$weapon_name.'\'s For '.number_format($total_cost).' Boss Points!</span>';	
$buy = mysql_query("INSERT INTO weapons 
			      (owner_id, weapon_id, name, attack, defense, owned, type, image) VALUES 
			      ('$id','$weapon_id','$weapon_name','$weapon_attack','$weapon_defense','$weapon_number','$weapon_type','$weapon_image')");
$update_amount = mysql_query("UPDATE limited_edition SET amount=(amount-".$weapon_number.") WHERE id=".$weapon_id."");
$update = mysql_query("UPDATE users SET points=(points-".$total_cost.") WHERE id='".$id."'");				  	
}
else {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Boss Points To Purchase '.$weapon_number.' '.$weapon_name.'\'s!</span></div>');	
$buy = '';
$update = '';
	}
}
// They Have Purchased The Weapon Before
elseif(mysql_num_rows($weapon_list) > 0) {
if($points >= $total_cost) {
$message = '<span class="Success">Success: You Purchased '.$weapon_number.' '.$weapon_name.'\'s For '.number_format($total_cost).' Boss Points!</span>';	
$buy = mysql_query("UPDATE weapons SET owned=(owned+".$weapon_number.") WHERE owner_id='".$id."' AND weapon_id='".$weapon_id."' AND type='".$weapon_type."'");
$update_amount = mysql_query("UPDATE limited_edition SET amount=(amount-".$weapon_number.") WHERE id=".$weapon_id."");
$update = mysql_query("UPDATE users SET points=(points-".$total_cost.") WHERE id='".$id."'");				  		
}
else {
$message = die('<div id="FightResults"><span class="Fail">Error: You Don\'t Have Enough Boss Points To Purchase '.$weapon_number.' '.$weapon_name.'\'s!</span></div>');	
$buy = '';
$update = '';	
	}
}
$res = $buy & $update & $update_amount;
echo '<div id="FightResults">'.$message.'</div>';
?>
