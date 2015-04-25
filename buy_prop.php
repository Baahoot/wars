<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$property_id = strip_tags($_GET['id']);
$property_number = strip_tags($_GET['amount']);
if ( isset ( $property_id ) )
{
	$property_id = mysql_real_escape_string($property_id);
	$sql = "SELECT * FROM property_list WHERE id='".$property_id."' LIMIT 1";
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
	// Property List
	$prop_id = $userp['id'];
	$prop_name = $userp['name'];
	$prop_cost = $userp['cost'];
	$prop_income = $userp['income'];
	$prop_image = $userp['image'];
	$prop_energy = $userp['energy'];
	$prop_needed = $userp['id_needed'];
	// Properties Purchased Check
	$properties = mysql_query("SELECT * FROM territory WHERE prop_id='".$prop_id."' AND owner_id='".$id."'");
	$prop_check = mysql_num_rows($properties);
	while($territory = mysql_fetch_array($properties)) {
	$territory_owner = $id;
	$territory_name = $territory['name'];	
	$territory_id = $territory['prop_id'];	
	$territory_owned = $territory['owned'];	
	$territory_cost = $territory['cost'];	
	}
	// Property Math
	$prop_fee = $prop_cost * $property_number;
	$income_fee = $prop_income * $property_number;
	$energy_fee = $prop_energy * $property_number;
	$fee_add = $prop_cost + $income_fee;
	if($property_number > 10) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Maximum Allowed Is 10!</span></div>');
	}
	if($property_number < 1) {
	$message = die('<div id="FightResults"><span class="Fail">Error: Fuck Off.</span></div>');
	}	
	// They haven't purchased this propert yet
	if (($prop_check == 0) & ($cash >= $prop_fee)) {
	// Checking if Energy Property
	if($prop_energy > 0) {
	$buy = mysql_query("INSERT INTO territory 
			          (name, image, owner_id, prop_id, owned, cost, energy) VALUES 
			          ('$prop_name','$prop_image','$id','$prop_id','$property_number','$fee_add','$energy_fee')");
	}
	else {
	$buy = mysql_query("INSERT INTO territory 
			          (name, image, owner_id, prop_id, owned, cost) VALUES 
			          ('$prop_name','$prop_image','$id','$prop_id','$property_number','$fee_add')");
	}
	if($prop_energy > 0) {
	$fee = mysql_query("UPDATE users SET cash=(cash - '".$prop_fee."'), e_income=(e_income + '".$energy_fee."') WHERE id='".$id."'");
	}
	elseif($prop_energy == 0) {
	$fee = mysql_query("UPDATE users SET cash=(cash - '".$prop_fee."'), income=(income + '".$income_fee."') WHERE id='".$id."'");
	}
	$message = '<div class="Success">Success: You Purchased '.$property_number.' '.$prop_name.'\'s For $'.number_format($prop_fee).'!</div>';
	$buy_again = '<span style="color: #0FF; font-weight: bold; cursor: pointer;" onClick="BuyProperty('.$prop_id.')">Buy '.$property_number.' More</span>';
	$result = $buy & $fee;	   		
	}
	// Updating Row (They have purchased this property before)
	elseif (($prop_check > 0) & ($cash >= ($territory_cost*$property_number))) {
	$prop_fee = $territory_cost * $property_number;
	$income_fee = $prop_income * $property_number;
	if($prop_energy > 0) {
	$buy = mysql_query("UPDATE territory SET owned=(owned + '".$property_number."'), cost=(cost + '".$income_fee."'),energy=(energy+".$energy_fee.") WHERE prop_id='".$territory_id."' AND owner_id='".$territory_owner."'");
	$fee = mysql_query("UPDATE users SET cash=(cash - '".$prop_fee."'), e_income=(e_income + '".$energy_fee."') WHERE id='".$id."'");
	}	
	elseif($prop_energy == 0) {
	$buy = mysql_query("UPDATE territory SET owned=(owned + '".$property_number."'), cost=(cost + '".$income_fee."') WHERE prop_id='".$territory_id."' AND owner_id='".$territory_owner."'");
	$fee = mysql_query("UPDATE users SET cash=(cash - '".$prop_fee."'), income=(income + '".$income_fee."') WHERE id='".$id."'");
	}
	$message = '<div class="Success">Success: You Purchased '.$property_number.' '.$prop_name.'\'s For $'.number_format($prop_fee).'!</div>';
	$buy_again = '<span style="color: #0FF; font-weight: bold; cursor: pointer;" onClick="BuyProperty('.$prop_id.')">Buy '.$property_number.' More</span>';
	$result = $buy & $fee;	   					
	}
	else {
	$message = die('<span class="Fail">Error: You Don\'t Have Enough Cash To Purchase '.$property_number.' '.$prop_name.'\'s!</span>');
	}
	echo $message.' '.$buy_again;
?>
