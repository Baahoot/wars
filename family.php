<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<div id="Achievements" align="center"></div>
<div id="AttackResults" align="center" class="PopUp"></div>
<?php
function time_elapsed_string($ptime) {
    $timestamp = time() - $ptime;
    
    if ($timestamp < 1) {
        return '1 second ago';
    }
    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
        $d = $timestamp / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's ago' : ' ago');
        }
    }
}
$fam_id = strip_tags($_GET['id']);
$get_family = mysql_query("SELECT * FROM family WHERE id='".$fam_id."'");
while($family = mysql_fetch_array($get_family)) {
$family_id = $family['id'];	
$family_owner = $family['owner_id'];	
$family_name = $family['name'];
$family_tags = $family['tags'];
$family_time = $family['timestamp'];
$wars_won = $family['wars_won'];
$wars_lost = $family['wars_lost'];
$wars_tied = $family['wars_tied'];
$total_wars = $wars_won + $wars_tied + $wars_lost;
// Get owner info 
$owner_info = mysql_query("SELECT username FROM users where id=".$family_owner."");
while($o_info = mysql_fetch_array($owner_info)) {
$owner_name = $o_info['username'];
}
// Check Family
$check_member = mysql_query("SELECT * FROM family_members WHERE family_id='".$fam_id."' AND mob_id=".$id."");
// Family Size
$total_members = mysql_query("SELECT * FROM family_members WHERE family_id='".$family_id."' ORDER BY id");
// Get members ids
while($mem_info = mysql_fetch_array($total_members)) {
$mem_id = $mem_info['mob_id'];
// Get members Won | Loss | Killed
$get_info = mysql_query("SELECT wins,loses,kills FROM users WHERE id=".$mem_id."");
while($fam_mem = mysql_fetch_array($get_info)) {
$mem_won += $fam_mem['wins'];
$mem_lost += $fam_mem['loses'];
$mem_kills += $fam_mem['kills'];
$mem_bounties += $fam_mem['bounties'];
}
if(mysql_num_rows($total_members) == 0) {
	$family_members = '1';
}
else {
	$family_members	= mysql_num_rows($total_members);
	}
  }
}
?>
<div align="center">
<div align="center" id="FamilyNameBox">
<div id="FamilyBoxName">
<?php echo $family_name ?>
</div>
</div>
</div>
<div id="Results" align="center"></div>
<div align="center">
<div align="center" id="ActionsBlock">
<?php 
if($family_owner == $id) {
$family_actions = 
'<div id="UserActions" onClick="ShowInvite()">Invite Member</div>
<div id="UserActions" onClick="ShowDelete()">Delete Family</div>';
}
if(mysql_num_rows($check_member) == 1 & $family_owner != $id) {
$family_actions = '<div id="UserActions" onClick="LeaveFamily()">Leave Family</div>';
}
echo $family_actions;
?>
</div>
</div>
<table width="600" align="center">
  <tr>
    <td width="245" valign="top">
    <div id="FamilyStatBox">
    <div id="FamilyStatName">Family ID: <span class="FamilyStatVal"><?php echo $family_id ?></span></div>
    <div id="FamilyStatName">Owner: 
    <span class="FamilyStatVal" onClick="ViewUser(<?php echo $family_owner ?>)" title="View Owner" style="cursor: pointer;">
	<?php echo $owner_name ?>
    </span>
    </div>    
    <div id="FamilyStatName">Tags: <span class="FamilyStatVal"><?php echo $family_tags ?></span></div>
    <div id="FamilyStatName">Created: <span class="FamilyStatVal"><?php echo time_elapsed_string($family_time) ?></span></div>
    <div id="FamilyStatName">Total Fights: <span class="FamilyStatVal"><?php echo number_format($mem_won + $mem_lost) ?></span></div>
    <div id="FamilyStatName">Total Won: <span class="FamilyStatVal"><?php echo number_format($mem_won) ?></span></div>
    <div id="FamilyStatName">Total Lost: <span class="FamilyStatVal"><?php echo number_format($mem_lost) ?></span></div>
    <div id="FamilyStatName">Total Kills: <span class="FamilyStatVal"><?php echo number_format($mem_kills) ?></span></div>
    <div id="FamilyStatName">Total Bounties: <span class="FamilyStatVal"><?php echo number_format($mem_kills) ?></span></div>
    </div>
    </td>
    <td width="343" valign="top">
    <div id="MembersBlock">
    <div id="UserInventory">Family Members [<?php echo number_format($family_members) ?>]</div>
	<?php
	// Get users from family
	$total_members = mysql_query("SELECT * FROM family_members WHERE family_id='".$fam_id."' ORDER BY id");
	while($member = mysql_fetch_array($total_members)) {
	$member_id = $member['mob_id'];
	//Select user info
	$select_member = mysql_query("SELECT * FROM users WHERE id='".$member_id."'");
	while($member_info = mysql_fetch_array($select_member)) {
	$member_id = $member_info['id'];
	$member_name = $member_info['username'];
	$member_image = $member_info['image'];
	}
	$check_family = mysql_query("SELECT * FROM family_members WHERE family_id='".$fam_id."' AND mob_id=".$id." ORDER BY id");
	// Check If Family Owner
	if($id == $family_owner) {
		$remove = '<div id="TrainAdd" onClick="RemoveFamily('.$member_id.')">Remove</div>';	
	}
	elseif(mysql_num_rows($check_family) == 1) {
		$remove = '<div id="TrainAdd" title="View '.$member_name.'" onClick="ViewUser('.$member_id.')">Visit</div>';	
	}
	else {
		$remove = '<div id="TrainAdd" title="Attack '.$member_name.'" onClick="Attack('.$member_id.')">Attack</div>';
	}
	echo 
	'<div id="TrainBlock">
	<div align="Center">
	<img src="'.$member_image.'" width="40" height="40" id="TrainImage" title="View '.$member_name.'" onClick="ViewUser('.$member_id.')" />
	</div>
	<center>'.$remove.'</center>
	</div>';		
	}
	?>    
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
    <?php if(mysql_num_rows($check_member) > 0): ?>        
    <div id="SubTabs" onClick="SubTab('f_bcs')">Broadcast</div> 
	<div id="SubContent">
    <div id="UserInventory">Broadcasts</div>  
    <div align="center">
    <form action="javascript:void" method="post" id="BCForm">
	<div align="left">
    <textarea id="bc_message" class="BC"></textarea>
    <input type="submit" value="Post" onClick="FBroadcast()" />
    <input type="reset" />
	</div>
    </form>
    </div>
	<div align="center" id="FamBroadcasts">
	<?php	
	$select_family = mysql_query("SELECT * FROM family_members WHERE mob_id='".$id."'");
	while($family = mysql_fetch_array($select_family)) {
	$family_id = $family['family_id'];	
	}
    $select_bc = mysql_query("SELECT * FROM family_bc WHERE family_id=".$family_id." ORDER BY id DESC LIMIT 30");
    if(mysql_num_rows($select_bc) == 0) {
    echo '<div align="center" class="Fail">..There Are Currently No Broadcasts..</div>';	
    }
    while($bc = mysql_fetch_array($select_bc)) {
	//Select user info
	$select_users = mysql_query("SELECT * FROM users WHERE id='".$bc['user_id']."'");
	while($user_info = mysql_fetch_array($select_users)) {
	$user_admin = $user_info['admin'];	
	$bc_id = $user_info['id'];
	$bc_name = $user_info['username'];
	$bc_image = $user_info['image'];
	}
    echo	
    '<table width="590" align="center" id="BCBlock">
      <tr>
        <td width="50" valign="top"><img src="'.$bc_image.'" width="50" height="50" /></td>
        <td width="528" valign="top">
        <div id="BCName" onClick="ViewUser('.$bc_id.')">'.$bc_name.'</div>
        <div id="BCTime">'.time_elapsed_string($bc['timestamp']).' 
        <span onClick="Reply(\''.$bc_name.'\')" style="color: #FFFFFF; cursor: pointer;">[Reply]</span>
        </div>
        <div style="border-bottom: 1px dotted #FFFFFF; width: 100%;"></div>
        <div id="BCMessage">'.$bc['message'].'</div>
        </td>
      </tr>
    </table>';
    }
    ?>
    </div>          
    <?php else: ?>
    <?php endif; ?>
    </td>
  </tr>
</table>
