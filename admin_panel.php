<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<!-- Active Players -->
<fieldset class="PanelFieldset">
<?php
$active_time = strtotime('-10 minutes',time());
$select_active = mysql_query("SELECT * FROM users WHERE last_active > ".$active_time."");
?>
<legend class="PanelName"><?php echo mysql_num_rows($select_active) ?>Active Players</legend>
<div class="Success" style="cursor: pointer;" onClick="PopUp('active_players')">Click To View Active Players</div>
</fieldset>
<!-- Hitlist Panel -->
<fieldset class="PanelFieldset">
<legend class="PanelName">Hitlist Panel</legend>
<div id="Tab" onClick="AdminHitlist(10)">Hitlist 10 Users</div>
<div id="Tab" onClick="AdminHitlist(100)">Hitlist 100 Users</div>
<div id="Tab" onClick="AdminHitlist(500)">Hitlist 500 Users</div>
</fieldset>
<!-- Hitlist Panel End -->
<!-- Add Mission Panel -->
<fieldset class="PanelFieldset">
<legend class="PanelName">Add New Mission</legend>
<form action="javascript:void" method="POST">
<table width="450">
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Level Unlocked: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisLevel" placeholder="Example: 25" /></td>
  </tr>
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Location: </td>
	<td align="left" style="min-width: 350px; max-width: 350px; color: #FFFFFF;">
	(Chicago <input type="radio" name="Location" id="MisLocation" value="Chicago" checked="checked" />)
	(New York <input type="radio" name="Location" id="MisLocation" value="New York" />)
	(Las Vegas <input type="radio" name="Location" id="MisLocation" value="Las Vegas" />)
	</td>
  </tr> 
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Mob Needed: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisMobSize" placeholder="Example: 5" /></td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Name: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisName" placeholder="Example: Build A Mission" /></td>
  </tr>
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Energy: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisEnergy" placeholder="Example: 13" /></td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Min Cash: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisCashMin" placeholder="Example: 250" /></td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Max Cash: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisCashMax" placeholder="Example: 1500" /></td>
  </tr>
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Min EXP: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisExpMin" placeholder="Example: 15" /></td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Max EXP: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisExpMax" placeholder="Example: 50" /></td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Weapon Needed: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;">
	<select id="MisWeaponNeed">
	  <?php
	  $get_weapons = mysql_query("SELECT id,name,level,type FROM all_equipment ORDER BY id");
	  while($weapon = mysql_fetch_array($get_weapons)) {
	  $weapon_id = $weapon['id'];
	  $weapon_name = $weapon['name'];
	  $weapon_level = $weapon['level'];
	  $weapon_type = $weapon['type'];
	  echo '<option name="WeaponNeed" value="'.$weapon_id.'">'.$weapon_name.' | Level: '.$weapon_level.' | Type: '.$weapon_type.'</option>';
	  }
	  ?>
	</select>
	</td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Amount Needed: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisNeedOwned" placeholder="Example: 15" /></td>
  </tr>   
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Weapon Reward: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;">
	<select id="MisWeaponReward">
	  <?php
	  $get_weapons = mysql_query("SELECT id,name,level,type FROM all_equipment ORDER BY id");
	  while($weapon = mysql_fetch_array($get_weapons)) {
	  $weapon_id = $weapon['id'];
	  $weapon_name = $weapon['name'];
	  $weapon_level = $weapon['level'];
	  $weapon_type = $weapon['type'];
	  echo '<option name="WeaponReward" value="'.$weapon_id.'">'.$weapon_name.' | Level: '.$weapon_level.' | Type: '.$weapon_type.'</option>';
	  }
	  ?>
	</select>
	</td>
  </tr>  
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Amount Rewarded: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MisRewardOwned" placeholder="Example: 3" /></td>
  </tr>   
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Take Weapon: </td>
	<td align="left" style="min-width: 350px; max-width: 350px; color: #FFFFFF;">
	Take The Needed Weapon Away? 
	(Yes <input type="radio" name="TakeWeapon" id="MisTake" value="Yes" checked="checked" />)
	(No <input type="radio" name="TakeWeapon" id="MisTake" value="No" />)
	</td>
  </tr>  
  <tr>
	<td colspan="2"><div id="Page">Mission Mastery</div></td>
  </tr>
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Mastery Needed: </td>
	<td align="left" style="min-width: 350px; max-width: 350px; color: #FFFFFF;">
	Times To Do Mission To Master Level: <input type="text" id="MasteryLevel" placeholder="Example: 12" /></td>
  </tr>    
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Mastery Type: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;">
	<select id="MasteryReward">
	  <option name="MasteryReward" value="Cash">Increase Cash</option>
	  <option name="MasteryReward" value="Points">Increase Boss Points</option>	  	  
	  <option name="MasteryReward" value="Health">Increase Max Health</option>
	  <option name="MasteryReward" value="Energy">Increase Max Energy</option>
	  <option name="MasteryReward" value="Stamina">Increase Max Stamina</option>
	  <option name="MasteryReward" value="Skills">Increase Skill Points</option>
	  <option name="MasteryReward" value="Attack">Increase Attack</option>
	  <option name="MasteryReward" value="Defense">Increase Defense</option>
	  <option name="MasteryReward" value="EXP">Increase EXP</option>	  
	</select>
	</td>
  </tr>
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Reward Amount: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;"><input type="text" id="MasteryAmount" placeholder="Example: 5000" /></td>
  </tr> 
  <tr>
	<td class="FormText" style="min-width: 100px; max-width: 100px;">Finish: </td>
	<td align="left" style="min-width: 350px; max-width: 350px;">
	<input type="reset" value="Reset" /> 
	<input type="submit" value="Preview" onClick="PreviewMission()" /> 
	<input type="submit" value="Create" onClick="CreateMission()" /> 
	</td>
  </tr>    
</table>
</form>
</fieldset>
<!-- Add Mission Panel End -->
<!-- Functions -->
<script>
function CreateMission() {
    $('#Mask').fadeIn(300);
    $('.PopUp').fadeIn(300);
    $('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
    var mis_level = $('#MisLevel').val();
    var mis_location = $('input[name=Location]:checked').val();
    var mis_mob = $('#MisMobSize').val();
    var mis_name = $('#MisName').val();
    var mis_energy = $('#MisEnergy').val();
    var mis_min_cash = $('#MisCashMin').val();
    var mis_max_cash = $('#MisCashMax').val();
    var mis_min_exp = $('#MisExpMin').val();
    var mis_max_exp = $('#MisExpMax').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var dataString = 'create_mission.php?level=' + mis_location + '&location=' + mis_location + '&mobsize=' + mis_mob + '&mis_name=' + mis_name + '&mis_energy=' + mis_energy + '&mis_min_cash=' + mis_min_cash + '&mis_max_cash=' + mis_max_cash + '&mis_min_exp=' + mis_min_exp + '&mis_max_exp=' + mis_max_exp;
    $.ajax({
        type: "POST",
        url: "create_mission.php?email=" + email + '&password=' + password,
        data: dataString,
        cache: false,
        success: function(Message) {
            $('#MissionResults').html(Message);
        }
    });
    return false;
}
function PreviewMission() {
    $('#Mask').fadeIn(300);
    $('.PopUp').fadeIn(300);
    $('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
    var mis_level = $('#MisLevel').val();
    var mis_location = $('input[name=Location]:checked').val();
    var mis_mob = $('#MisMobSize').val();
    var mis_name = $('#MisName').val();
    var mis_energy = $('#MisEnergy').val();
    var mis_min_cash = $('#MisCashMin').val();
    var mis_max_cash = $('#MisCashMax').val();
    var mis_min_exp = $('#MisExpMin').val();
    var mis_max_exp = $('#MisExpMax').val();
    var mis_weapon_need = document.getElementById("MisWeaponNeed").value;
    var mis_need_owned = $('#MisNeedOwned').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var mis_level = $('#MisLevel').val();
    var dataString = 'preview_mission.php?level=' + mis_level + '&location=' + mis_location + '&mobsize=' + mis_mob + '&mis_name=' + mis_name + '&mis_energy=' + mis_energy + '&mis_min_cash=' + mis_min_cash + '&mis_max_cash=' + mis_max_cash + '&mis_min_exp=' + mis_min_exp + '&mis_max_exp=' + mis_max_exp + '&mis_weapon_need=' + mis_weapon_need + '&mis_need_owned=' + mis_need_owned;
    $.ajax({
        type: "POST",
        url: "preview_mission.php,
        data: dataString,
        cache: false,
        success: function(Message) {
            $('.PopUp').html(Message);
        }
    });
    return false;
}
</script>
<!-- Functions End -->
<!-- Award Codes -->
<fieldset class="PanelFieldset">
<legend class="PanelName">Award Codes</legend>
<script type="text/javascript">
function Generate() {
	var item = $('#Item').val();
	var amount = $('#Amount').val();
	$('#Results').html('<div id="Loading">..Loading..</div>');
	$('#Results').load('generate_code.php?item='+item+'&amount='+amount);
	$('#Results').show();
	$('#Codes').html('<div id="Loading">..Loading..</div>');
	$('#Codes').load('awards_codes.php');
	$('#Codes').show('awards_codes.php');
}
</script>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<div align="Center">
<div style="width: 250px; background-color: #333333; border-radius: 6px; padding: 10px; border: 1px solid #FFFFFF;" align="left">
<div id="Results" align="center"></div>
<form action="javascript:void" method="POST">
<span class="FormText">Item :: </span>
<select id="Item">
  <option value="1">Cash</option>
  <option value="2">Skill Points</option>
  <option value="3">Boss Points</option>
  <option value="4">EXP</option>
  <option value="5">Health</option>
  <option value="6">Energy</option>
  <option value="7">Stamina</option>
  <option value="8">Knuckles</option>  
</select><br />
<span class="FormText">Amount :: </span><input type="text" id="Amount" />
<div style="padding-top: 10px;"><input type="submit" value="Generate" onClick="Generate()" /> | <input type="reset" value="Reset" /></div>
</form>
</div>
</div>
<!-- Codes -->
<div align="Center" id="Codes">
<?php include 'awards_codes.php' ?>
</div>
</fieldset>
<!-- Hitlist Race -->
<fieldset class="PanelFieldset">
<legend class="PanelName">Hitlist Race Stats</legend>
<?php
$count = 1;
$result = mysql_query("SELECT * FROM hitlist_race ORDER BY bounties DESC");
echo '<div style="color: #FFFFFF;">Total Users: '.mysql_num_rows($result).'</div>';
while($row = mysql_fetch_array($result)) {
$select_info = mysql_query("SELECT * FROM users WHERE id=".$row['owner_id']."");
while($info = mysql_fetch_array($select_info)) {
$usersname = $info['username'];
$user_stam = $info['stamina'];
}
echo '<div style="color: green;">'.$count++.'.'.$usersname.' | Bounties: '.$row['bounties'].' | Stamina: '.$user_stam.'</div>';
}
?>
</fieldset>
