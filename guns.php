<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<?php
$select_weapons = mysql_query("SELECT * FROM all_equipment WHERE level<=".$level." AND type='gun' ORDER BY cost");
while($weapon = mysql_fetch_array($select_weapons)) {	
// check if they own the weapon
$owned_weapon = mysql_query("SELECT * FROM weapons WHERE owner_id='".$id."' AND weapon_id='".$weapon['id']."' AND type='".$weapon['type']."'");
if(mysql_num_rows($owned_weapon) == 0) {
$weapons_owned = '0';
$weapon_sell = $weapon['sell'];
}
if($weapon['sell'] == 'Yes') {
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
	<input type="submit" value="Buy" onClick="BuyWeapon('.$weapon['id'].',\''.$weapon['type'].'\')" />
	<input type="submit" value="Sell" onClick="SellWeapon('.$weapon['id'].',\''.$weapon['type'].'\')" />		
	</form>';	
}
elseif($weapon['sell'] == 'No') {
$purchase = 'Can\'t Purchase/Sell';	
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
    <div id="WeaponStat">Cost: $'.number_format($weapon['cost']).' | Upkeep: $'.number_format($weapon['upkeep']).'</div>
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
