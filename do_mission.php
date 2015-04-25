<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$mission_id = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $mission_id ) )
{
	$mission_id = mysql_real_escape_string($mission_id);
	$sql = "SELECT * FROM missions WHERE id='".$mission_id."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else {
		die('Mission Doesn\'t Exist!');
	}
}
?>
<?php
// Getting Info
$m_id = $userp['id'];
$m_name = $userp['name'];
$m_energy = $userp['energy'];
$m_cash_min = $userp['min_cash'];
$m_cash_max = $userp['max_cash'];
$m_exp_min = $userp['min_exp'];
$m_exp_max = $userp['max_exp'];
$m_mob = $userp['mob'];
$m_current = $userp['current'];
// Weapons Needed Variables
$need_weap_id = $userp['need_weap_id'];
$need_weap_type = $userp['need_weap_type'];
$need_weap_owned = $userp['need_weap_owned'];
// Weapons Rewarded Variables
$reward_weap_id = $userp['reward_weap_id'];
$reward_weap_type = $userp['reward_weap_type'];
$reward_weap_owned = $userp['reward_weap_owned'];
$req_take = $userp['req_take'];
// Gained During Mission
$cash_gain = (rand($m_cash_min,$m_cash_max));
$exp_gain = (rand($m_exp_min,$m_exp_max));
// Check mob size
if($m_current == '0') {
$message = die('<span class="Fail">Error: This Mission Isn\'t Available At This Time!</span>');	
}
if($mob_size < $m_mob) {
$message = die('<div id="MissionResult" align="Center"><div id="MissionFailed">You Need At least '.$m_mob.' Mob To Complete '.$m_name.'</div></div>');
}
if($need_weap_id == 0) {
	
}
elseif($need_weap_id > 0) {
// Retrieve Needed Weapon Info
$need_weapon_info = mysql_query("SELECT * FROM all_equipment WHERE id=".$need_weap_id." AND type='".$need_weap_type."'");
while($need_w_info = mysql_fetch_array($need_weapon_info)) {
$n_weapon_name = $need_w_info['name'];	
}
// Retrieve Rewarded Weapon Info
$reward_weapon_info = mysql_query("SELECT * FROM all_equipment WHERE id=".$reward_weap_id." AND type='".$reward_weap_type."'");
while($need_r_info = mysql_fetch_array($reward_weapon_info)) {
$r_weapon_name = $need_r_info['name'];	
$r_weapon_image = $need_r_info['image'];	
$r_weapon_attack = $need_r_info['attack'];	
$r_weapon_defense = $need_r_info['defense'];	
$r_weapon_type = $need_r_info['type'];	
}
// Check if owned weapons
$select_n_weapons = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND weapon_id=".$need_weap_id." AND type='".$need_weap_type."' AND owned>=".$need_weap_owned."");
if(mysql_num_rows($select_n_weapons) == 0) {
$reward_mess = die('<center><span class="Fail">Error: You Need '.$need_weap_owned.' '.$n_weapon_name.'\'s To Do This Job!</span></center>');	
}
elseif(mysql_num_rows($select_n_weapons) > 0) {
if($reward_weap_id == 0) {
// Do Nothing
}
elseif($reward_weap_id > 0) {	
$select_r_weapons = mysql_query("SELECT * FROM weapons WHERE owner_id=".$id." AND weapon_id=".$reward_weap_id." AND type='".$reward_weap_type."'");
$random_reward = rand(1,2);
// They don't own the rewarded weapon
if(mysql_num_rows($select_r_weapons) == 0) {	
if($random_reward == 1) {
$reward_mess = '<div style="color: green; font-style: italic; font-weight: bold;" align="center">You Recieved '.$reward_weap_owned.' '.$r_weapon_name.'\'s</div>';
$reward_weapon= mysql_query("INSERT INTO weapons 
			      (owner_id, weapon_id, name, attack, defense, owned, type, image) VALUES 
			   ('$id','$reward_weap_id','$r_weapon_name','$r_weapon_attack','$r_weapon_defense','1','$r_weapon_type','$r_weapon_image')");
}
if($random_reward == 2) {
// Do Nothing	
}
} // Don't Own Weapons End
// They own the weapons
elseif(mysql_num_rows($select_r_weapons) == 1) {	
if($random_reward == 1) {
$reward_mess = '<div style="color: green; font-style: italic; font-weight: bold;" align="center">You Recieved '.$reward_weap_owned.' '.$r_weapon_name.'\'s</div>';
$reward_weapon = mysql_query("UPDATE weapons SET owned=(owned+".$reward_weap_owned.") WHERE owner_id=".$id." AND weapon_id=".$reward_weap_id." AND type='".$reward_weap_type."'");
	}
}
if($random_reward == 2) {
// Do Nothing
}
}
}
}
if($req_take == 0) {
// Do Nothing
}
elseif($req_take == 1) {
while($take_info = mysql_fetch_array($select_n_weapons)) {
$take_owned = $take_info['owned'];	
}
if($take_owned > 0) {
$take_message = 'You Used '.$need_weap_owned.' '.$n_weapon_name.'!';
$take_weapon = mysql_query("UPDATE weapons SET owned=(owned-".$need_weap_owned.") WHERE owner_id=".$id." AND weapon_id=".$need_weap_id." AND type='".$need_weap_type."'");	
} // Take Owned End
} // Req Take End
if($energy >= $m_energy) {
$message = 
'<div id="MissionSuccess">Success: You Completed '.$m_name.'!</div>
<div id="MissionUsed">You Used '.number_format($m_energy).' Energy! '.$take_message.'</div>
<div id="MissionPayed">You Gained $'.number_format($cash_gain).' And '.number_format($exp_gain).' EXP! <div style="display: inline-block;">'.$reward_mess.'</div></div>';
$do_again = '<div align="center" style="color: #0FF; font-weight: bold; cursor: pointer;" onclick="Mission('.$m_id.')">Do Again</div>';
// Select Mission Mastery
$select_mastery = mysql_query("SELECT * FROM mission_mastery WHERE owner_id='".$id."' AND mission_id='".$mission_id."'");
// They haven't started the Mastery yet
if(mysql_num_rows($select_mastery) == 0) {
$mastery_list = mysql_query("SELECT * FROM mastery_list WHERE mission_id='".$mission_id."'");	
while($mastery_info = mysql_fetch_array($mastery_list)) {
$info_mastery = $mastery_info['max_mastery'];
$info_reward = $mastery_info['reward'];
$info_query = $mastery_info['reward_query'];
}
$mastery_query = mysql_query("INSERT INTO mission_mastery 
(mission_id, owner_id, mastery, max_mastery, level, reward, reward_query) 
VALUES 
('$mission_id', '$id', '1', '$info_mastery', '1', '$info_reward', '$info_query')");	
}
elseif(mysql_num_rows($select_mastery) == 1) {
$mastery_query = mysql_query("UPDATE mission_mastery SET mastery=(mastery+1) WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
while($update_mastery = mysql_fetch_array($select_mastery)) {
$mastery_level = $update_mastery['level'];
$mastery_current = $update_mastery['mastery'];
$mastery_max = $update_mastery['max_mastery'];
$new_mastery = ($mastery_max / 2);
$mastery_max_reward = $update_mastery['reward'];
$mastery_max_query = $update_mastery['reward_query'];
$mastery_complete = $update_mastery['complete'];
}
if(($mastery_current+1) >= $mastery_max) {
if ($mastery_level < 5) {
$sel_max_mastery = mysql_query("SELECT * FROM mastery_list WHERE mission_id='".$mission_id."'");	
while($sel_max_mast = mysql_fetch_array($sel_max_mastery)) {
$new_max_mastery = $sel_max_mast['max_mastery'];
}
$mastery_complete = mysql_query("UPDATE mission_mastery SET level=(level+1),mastery='0',max_mastery=(max_mastery+".$new_max_mastery.") WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
$mastery_message = '<div id="MasteryMessage">Success: You Mastered Level '.$mastery_level.'! You Recieved '.$mastery_max_reward.'!</div>';
$mastery_update = mysql_query("UPDATE users SET ".$mastery_max_query." WHERE id='".$id."'");
}
elseif ($mastery_level == 5) {
// Giving Last Reward
if($mastery_complete == 0) {
$mastery_update_last = mysql_query("UPDATE users SET ".$mastery_max_query.",points=(points+3) WHERE id='".$id."'");
$mastery_complete = mysql_query("UPDATE mission_mastery SET complete='1' WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
$mastery_message = '<div id="MasteryMessage">Success: You Mastered Level '.$mastery_level.'! You Recieved '.$mastery_max_reward.'!</div><span style="color: #00f000; margin-top: 3px;">You Received 3 Boss Points For Mastering The Mission!';
}
$mastery_complete = mysql_query("UPDATE mission_mastery SET mastery=".$mastery_max." WHERE mission_id='".$mission_id."' AND owner_id='".$id."'");
	}
  }
}
// Update Users Stats
$update = mysql_query("UPDATE users SET cash=(cash + $cash_gain), exp=(exp + $exp_gain), energy=(energy - $m_energy), missions=(missions + 1) WHERE id='".$id."'");
$res = $update & $mastery_query & $mastery_complete & $mastery_update & $reward_weapon & $take_weapon;
}
else {
$message = die('<div id="MissionResult"><div id="MissionFailed">You Don\'t Have Enough Energy To Complete '.$m_name.'</div></div>');	
}
echo '<center>'.$message.$mastery_message.$do_again.'</center>';
?>
