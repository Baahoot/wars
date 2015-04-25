<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<?php
$select_weapons = mysql_query("SELECT * FROM limited_edition ORDER BY id DESC");
while($weapon = mysql_fetch_array($select_weapons)) {	
// check if they own the weapon
$owned_weapon = mysql_query("SELECT * FROM weapons WHERE owner_id='".$id."' AND weapon_id='".$weapon['id']."' AND type='".$weapon['type']."'");
// Getting Type
if($weapon['gun_type'] == 'melee') {
$gun_type = 'Melee';	
}
if($weapon['gun_type'] == 'gun') {
$gun_type = 'Gun';	
}
if($weapon['gun_type'] == 'armor') {
$gun_type = 'Armor';	
}
if($weapon['gun_type'] == 'bomb') {
$gun_type = 'Bomb';	
}
if($weapon['gun_type'] == 'vehicle') {
$gun_type = 'Vehicle';	
}
if(mysql_num_rows($owned_weapon) == 0) {
$weapons_owned = '0';
}
if($weapon['amount'] == 0) {
$purchase = 'Sold Out';	
}
if($weapon['amount'] > 0) {
$purchase = 
	'<form action="javascript:void;" method="POST">
  	<select id="weapon_number'.$weapon['id'].'">
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
  	  <option value="100">100</option>
	</select>
	<input type="submit" value="Buy" onClick="BuyLimitedWeapon('.$weapon['id'].',\''.$weapon['type'].'\')" />
	</form>';	
}
while($weapon_owned = mysql_fetch_array($owned_weapon)) {
if(mysql_num_rows($owned_weapon) > 0) {
$weapons_owned = $weapon_owned['owned'];
	}
}
echo 
'<div id="Results'.$weapon['id'].'"></div>
<table width="600" id="WeaponBlock">
  <tr>
    <td colspan="3"><div id="WeaponName">'.$weapon['name'].'</div></td>
  </tr>
  <tr>
    <td width="150" valign="top"><img src="images/'.$weapon['image'].'.png" width="150" height="65" /></td>
    <td width="284" valign="top">
    <div id="WeaponStat">Remaining: '.$weapon['amount'].' | Weapon Type: '.$gun_type.'</div>
    <div id="WeaponStat">Cost: '.$weapon['cost'].' Boss Points</div>
    <div id="WeaponStat">Attack: '.$weapon['attack'].'</div>
    <div id="WeaponStat">Defense: '.$weapon['defense'].'</div>
    </td>
    <td width="150">
	<div id="WeaponStat">You Own: <span id="WeaponOwn'.$weapon['id'].'">'.number_format($weapons_owned).'</span></div>
	'.$purchase.'
	</td>
  </tr>
</table>';
}
?>
</body>
