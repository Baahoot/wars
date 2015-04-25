<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css">
<div id="Page" align="center">Basic Properties</div>
<div align="center">
<div align="left" style="width: 600px;">
<?php
$select_estate = mysql_query("SELECT * FROM property_list WHERE type='Basic' AND level<=".$level." ORDER BY cost");
while($prop_list = mysql_fetch_array($select_estate)) {
$prop_id = $prop_list['id'];
$prop_name = $prop_list['name'];
$prop_image = $prop_list['image'];
$prop_income = $prop_list['income'];
$prop_cost = $prop_list['cost'];
// Properties Purchased Check
$properties = mysql_query("SELECT * FROM territory WHERE prop_id='".$prop_id."' AND owner_id='".$id."'");
// Check To See If They've Purchased This Property Yet
if (mysql_num_rows($properties) == 0) {
	$territory_owned = '0';
	$territory_cost = $prop_cost;
}	
while($territory = mysql_fetch_array($properties)) {
if (mysql_num_rows($properties) > 0) {
	$territory_owned = $territory['owned'];
	$territory_cost = $territory['cost'];
	}	
  }
echo
'<div id="PropBlock">
<div id="PropName">'.$prop_name.'</div>
<div align="center"><img src="images/'.$prop_image.'.png" width="180" height="80" /></div>
<div id="PropOwned">You Own: <span id="PropOwn'.$prop_id.'">'.number_format($territory_owned).'</span></div>
<div id="PropIncome">Income: $'.number_format($prop_income).'</div>
<div id="PropIncome">Cost: $<span id="PropCost'.$prop_id.'">'.number_format($territory_cost).'</span></div>
<div style="margin-top: 2px;">
<form action="javascript:void;" method="POST">
  <select id="property_number'.$prop_id.'">
  <option value="1">1</option>	 
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<input type="submit" value="Buy" onClick="BuyProperty('.$prop_id.')" />
<input type="submit" value="Sell" onClick="SellProperty('.$prop_id.')" />		
</form>
</div>
</div>';  
}
?>
</div>
</div>
<div id="Page" align="center">Industrial Properties</div>
<div align="center">
<div align="left" style="width: 600px;">
<?php
$select_estate = mysql_query("SELECT * FROM property_list WHERE type='Industrial' AND level<=".$level." ORDER BY cost");
while($prop_list = mysql_fetch_array($select_estate)) {
$prop_id = $prop_list['id'];
$prop_name = $prop_list['name'];
$prop_image = $prop_list['image'];
$prop_income = $prop_list['income'];
$prop_cost = $prop_list['cost'];
// Properties Purchased Check
$properties = mysql_query("SELECT * FROM territory WHERE prop_id='".$prop_id."' AND owner_id='".$id."'");
// Check To See If They've Purchased This Property Yet
if (mysql_num_rows($properties) == 0) {
	$territory_owned = '0';
	$territory_cost = $prop_cost;
}	
while($territory = mysql_fetch_array($properties)) {
if (mysql_num_rows($properties) > 0) {
	$territory_owned = $territory['owned'];
	$territory_cost = $territory['cost'];
	}	
  }
echo
'<div id="PropBlock">
<div id="PropName">'.$prop_name.'</div>
<div align="center"><img src="images/'.$prop_image.'.png" width="180" height="80" /></div>
<div id="PropOwned">You Own: <span id="PropOwn'.$prop_id.'">'.number_format($territory_owned).'</span></div>
<div id="PropIncome">Income: $'.number_format($prop_income).'</div>
<div id="PropIncome">Cost: $<span id="PropCost'.$prop_id.'">'.number_format($territory_cost).'</span></div>
<div style="margin-top: 2px;">
<form action="javascript:void;" method="POST">
  <select id="property_number'.$prop_id.'">
  <option value="1">1</option>	 
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<input type="submit" value="Buy" onClick="BuyProperty('.$prop_id.')" />
<input type="submit" value="Sell" onClick="SellProperty('.$prop_id.')" />		
</form>
</div>
</div>';  
}
?>
</div>
</div>
<!-- Energy Properties -->
<div id="Page" align="center">Energy Properties</div>
<div align="center">
<div align="left" style="width: 600px;">
<?php
$select_estate = mysql_query("SELECT * FROM property_list WHERE type='Energy' AND level<=".$level." ORDER BY cost");
while($prop_list = mysql_fetch_array($select_estate)) {
$prop_id = $prop_list['id'];
$prop_name = $prop_list['name'];
$prop_image = $prop_list['image'];
$prop_income = $prop_list['income'];
$prop_cost = $prop_list['cost'];
$prop_energy = $prop_list['energy'];
// Properties Purchased Check
$properties = mysql_query("SELECT * FROM territory WHERE prop_id='".$prop_id."' AND owner_id='".$id."'");
// Check To See If They've Purchased This Property Yet
if (mysql_num_rows($properties) == 0) {
	$territory_owned = '0';
	$territory_cost = $prop_cost;
}	
while($territory = mysql_fetch_array($properties)) {
if (mysql_num_rows($properties) > 0) {
	$territory_owned = $territory['owned'];
	$territory_cost = $territory['cost'];
	}	
  }
echo
'<div id="PropBlock">
<div id="PropName">'.$prop_name.'</div>
<div align="center"><img src="images/'.$prop_image.'.png" width="180" height="80" /></div>
<div id="PropOwned">You Own: <span id="PropOwn'.$prop_id.'">'.number_format($territory_owned).'</span></div>
<div id="PropIncome">Income: '.number_format($prop_energy).' Energy</div>
<div id="PropIncome">Cost: $<span id="PropCost'.$prop_id.'">'.number_format($territory_cost).'</span></div>
<div style="margin-top: 2px;">
<form action="javascript:void;" method="POST">
  <select id="property_number'.$prop_id.'">
  <option value="1">1</option>	 
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
<input type="submit" value="Buy" onClick="BuyProperty('.$prop_id.')" />
<input type="submit" value="Sell" onClick="SellProperty('.$prop_id.')" />		
</form>
</div>
</div>';  
}
?>
</div>
</div>
