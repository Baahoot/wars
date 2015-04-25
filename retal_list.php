<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div align="center "id="SubPage">Retaliation List: <i>Lower Level Players Who Have Attacked You And Won.</i></div>
<div id="Achievements" align="center"></div>
<div id="AttackResults" align="center" class="PopUp"></div>
<?php
$select_users = mysql_query("SELECT * FROM retaliation WHERE owner_id=".$id." ORDER BY id DESC");
if(mysql_num_rows($select_users) == 0) {
die('<div align="center" class="Fail">..There Are Currently No Attacks To Retaliate..</div>');
}
while($get_info = mysql_fetch_array($select_users)) {
$user_id = $get_info['user_id'];
$attacks = $get_info['attacks'];
// Get user info
$get_user = mysql_query("SELECT * FROM users WHERE id='".$user_id."'");
while($user_info = mysql_fetch_array($get_user)) {
$user_id = $user_info['id'];
$user_name = $user_info['username'];
$user_image = $user_info['image'];
$user_level = $user_info['level'];
}
// Check to see if remaining attacks
if($attacks == 0) {
echo '';
$delete_retal = mysql_query("DELETE FROM retaliation WHERE owner_id=".$id." AND user_id=".$user_id."");	
}
else {
echo
'<table width="600" align="center" id="FightBlock">
  <tr>
    <td width="60">
	<img src="'.$user_image.'" width="60" height="60" style="border-radius: 6px; -moz-border-radius: 6px;"/>
	</td>
    <td width="374">
	<div id="FightUsername" onClick="ViewUser('.$user_id.')">'.$user_name.'</div>
	<div id="FightLevel">Level: '.number_format($user_level).'</div>
	<div id="FightLevel">Attacks: '.number_format($attacks).'</div>
	</td>
    <td width="150" align="center">
	<input type="submit" value="Attack" onClick="RetalAttack('.$user_id.')" id="AttackButton" />
	</td>
  </tr>
</table>';	
	}
}
?>
