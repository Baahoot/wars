<?php session_start() ?>
<?php require 'connect.php' ?>
<div id="Achievements" align="center"></div>
<div id="Results" align="center"></div>
<div align="center "id="SubPage"><?php echo $location ?> Jobs Pack</div>
<?php
$missions_list = mysql_query("SELECT * FROM missions WHERE location='".$location."' ORDER BY level DESC");
while($mission = mysql_fetch_array($missions_list)) {
if ($level >= $mission['level']) {	
// Retrieve Needed Weapon Info
$need_weapon_info = mysql_query("SELECT * FROM all_equipment WHERE id=".$mission['need_weap_id']." AND type='".$mission['need_weap_type']."'");
if(mysql_num_rows($need_weapon_info) == 1) {
while($need_w_info = mysql_fetch_array($need_weapon_info)) {
$n_weapon_name = $need_w_info['name'].'\'s';	
	}
}
elseif(mysql_num_rows($need_weapon_info) == 0) {
$n_weapon_name = '';	
}
// Retrieve Rewarded Weapon Info
$reward_weapon_info = mysql_query("SELECT * FROM all_equipment WHERE id=".$mission['reward_weap_id']." AND type='".$mission['reward_weap_type']."'");
if(mysql_num_rows($reward_weapon_info) == 1) {
while($need_r_info = mysql_fetch_array($reward_weapon_info)) {
$r_weapon_name = $need_r_info['name'].'\'s';	
	}
}
elseif(mysql_num_rows($reward_weapon_info) == 0) {
$r_weapon_name = '';	
}
// Select Mission Mastery
$select_mastery = mysql_query("SELECT * FROM mission_mastery WHERE owner_id='".$id."' AND mission_id='".$mission['id']."'");
if(mysql_num_rows($select_mastery) == 0) {
$mastery = '0';
$mastery_level = '1';
}
while($mis_mastery = mysql_fetch_array($select_mastery)) {
$les_mastery = $mis_mastery['mastery'];
$max_mastery = $mis_mastery['max_mastery'];
$mastery_level = $mis_mastery['level'];
if ($les_mastery >= $max_mastery) {
$mastery = '100';
}
else {
$mastery = ($les_mastery / $max_mastery) * 100;	
	}
}
// Check if mission is limited time only
if($mission['limited'] == 1) {
$mis_limited = '<span style="color: #00f000">[Limited] </span>';	
}
else {
$mis_limited = '';	
}
echo
'<table width="600" align="center" id="MissionBlock">
  <tr>
    <td colspan="3">
    <div id="MissionName">
    '.$mis_limited.''.$mission['name'].'
    <div id="MissionsBar">
	<div id="MissionMastery">Mastery Level: <span id="MasteryLevel'.$mission['id'].'">'.$mastery_level.'</span></div>
	<div id="MasteryBar">
    <div id="MasteryWidth'.$mission['id'].'" style="width: '.number_format($mastery).'%; max-width: 100%; background: linear-gradient(to bottom, #ffc600 0%, #111111 100%) repeat scroll 0% 0% #ffc600; border-radius: 5px; -moz-border-radius: 5px; vertical-align: center;">
    <div style="width: 100px; vertical-align: middle; font-size: 12px; color: #ffffff; margin-left: 4px;">'.number_format($mastery).'%</div>
    </div>
    </div>    
    </div>
    </div>
    </td>
  </tr>  
  <tr>
    <td width="242" valign="top" style="border-right: 1px dotted #FFFFFF;">
    <div id="MissionReqTitle">Requirements: </div>
    <div id="MissionReq">
    &#8226; Energy: '.number_format($mission['energy']).' <br />
    &#8226; Weapons: '.number_format($mission['need_weap_owned']).' '.$n_weapon_name.' <br />
	&#8226; Mob Size: '.$mission['mob'].'
    </div>
    </td>
    <td width="242" valign="top" style="border-right: 1px dotted #FFFFFF;">
    <div id="MissionPayTitle">Payout: </div>
    <div id="MissionPayout">
    &#8226; Cash: $'.number_format($mission['min_cash']).' - $'.number_format($mission['max_cash']).' <br />
    &#8226; Exp: '.number_format($mission['min_exp']).' - '.number_format($mission['max_exp']).' <br />
    &#8226; Weapons: '.$mission['reward_weap_owned'].' '.$r_weapon_name.'
    </div>    
    </td>
    <td width="100" align="center">
    <input type="submit" value="Do Job" onclick="Mission('.$mission['id'].')" id="MissionButton" />
    </td>
  </tr>
</table>';
	}
}
?>
