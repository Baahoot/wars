<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<link href="app.css" rel="stylesheet" type="text/css" />
<?php include 'stats.php' ?>
<body onLoad="XML(); BCtime()">
<?php
$fetchstats = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $fetchstats ) )
{
	$fetchstats = mysql_real_escape_string($fetchstats);
	$sql = "SELECT * FROM users WHERE id='".$fetchstats."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else { 
	die('<div align="center" class="Fail">Error: User Doesn\'t Excist!</div>');
	}
}
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
?>
<title>PsychoWars: <?php echo $userp['username'] ?></title>
<div id="Content" align="center">
<div id="AttackResults"></div>
<div id="StatUsername" align="center" onClick="ViewUser(<?php echo $userp['id'] ?>)">
<?php echo $userp['username'] ?>'s Stats
</div>
<div align="center" id="ActionsBlock">
<div id="UserActions" onClick="Attack(<?php echo $userp['id'] ?>)">Attack</div>
<div id="UserActions" onClick="Punch(<?php echo $userp['id'] ?>)">Punch</div>
<div id="UserActions" onClick="SetAmount(<?php echo $userp['id'] ?>)">Add To Hitlist</div>
<?php if($userp['id'] == $id): ?>
<?php else: ?>
<div id="UserActions" onClick="MobInvite(<?php echo $userp['id'] ?>)">Add To Mob</div>
<?php endif; ?>
<div id="UserActions" onClick="WallLink(<?php echo $userp['id'] ?>)">User Link</div>
<div id="WallLink" class="PopUp" align="Center"></div>
</div>
<div align="center" id="SetBountyBlock"></div>
<table width="600" align="center">
  <tr>
    <td width="265" valign="top">
    <div id="StatTitle">Career Stats</div> <div id="StatTitleV">Value</div>
    <div id="StatName">ID: </div> <div id="StatValue"><?php echo $userp['id'] ?></div>
    <div id="StatName">Created: </div> <div id="StatValue"><?php echo time_elapsed_string($userp['joined']) ?></div>
    <div id="StatName">Level: </div> <div id="StatValue"><?php echo $userp['level'] ?></div>
    <div id="StatName">Location: </div> <div id="StatValue"><?php echo $userp['location'] ?></div>    
    <div id="StatName">Bounty: </div> <div id="StatValue">$<?php echo number_format(($userp['income'] * 10)) ?></div>    
    <div id="StatName">Jobs Complete: </div> <div id="StatValue"><?php echo number_format($userp['missions']) ?></div>
    <div id="StatTitle">Fight Stats</div> <div id="StatTitleV">Value</div>
    <div id="StatName">Won: </div> <div id="StatValue"><?php echo number_format($userp['wins']) ?></div>
    <div id="StatName">Lost: </div> <div id="StatValue"><?php echo number_format($userp['loses']) ?></div>
    <div id="StatName">Kills: </div> <div id="StatValue"><?php echo number_format($userp['kills']) ?></div>
    <div id="StatName">Deaths: </div> <div id="StatValue"><?php echo number_format($userp['deaths']) ?></div>
    <div id="StatName">Bounties: </div> <div id="StatValue"><?php echo number_format($userp['bounties']) ?></div> 
    </td>
    <td width="323" valign="top">
    <div id="SubTabs" onClick="TrophyTab()">Trophies</div>
    <div id="SubTabs" onClick="EquipmentTab()">Equipment</div>
    <div id="SubTabs" onClick="EstateTab()">Estate</div>
    <div id="TrophyTab">
    <div id="UserInventory">Trophies</div>
    <?php
	// Beta Achievment
	if($userp['ach_beta'] == 3) {
	$ach_m_beta = '<img src="images/achievement/Gold-Beta.png" height="60" width="60" title="Gold Beta Tester" />';
	}
	if($userp['ach_beta'] == 2) {
	$ach_m_beta = '<img src="images/achievement/Silver-Beta.png" height="60" width="60" title="Silver Beta Tester" />';
	}
	if($userp['ach_beta'] == 1) {
	$ach_m_beta = '<img src="images/achievement/Bronze-Beta.png" height="60" width="60" title="Bronze Beta Tester" />';
	}
	echo '<div id="Achievement">'.$ach_m_beta.'</div>';	
	// Mission Achievment
	if($userp['ach_missions'] == 4) {
	$ach_miss = '<img src="images/achievement/Diamond-Mission.png" height="60" width="60" title="Diamond Jobs Complete" />';
	}	
	if($userp['ach_missions'] == 3) {
	$ach_miss = '<img src="images/achievement/Gold-Mission.png" height="60" width="60" title="Gold Jobs Complete" />';
	}
	if($userp['ach_missions'] == 2) {
	$ach_miss = '<img src="images/achievement/Silver-Mission.png" height="60" width="60" title="Silver Jobs Complete" />';
	}
	if($userp['ach_missions'] == 1) {
	$ach_miss = '<img src="images/achievement/Bronze-Mission.png" height="60" width="60" title="Bronze Jobs Complete" />';
	}
	echo '<div id="Achievement">'.$ach_miss.'</div>';
	// Mob Size Achievement	
	if($userp['ach_mobsize'] == 4) {
	$ach_mobs = '<img src="images/achievement/Diamond-Mobsize.png" height="60" width="60" title="Diamond Mob Size" />';
	}	
	if($userp['ach_mobsize'] == 3) {
	$ach_mobs = '<img src="images/achievement/Gold-Mobsize.png" height="60" width="60" title="Gold Mob Size" />';
	}
	if($userp['ach_mobsize'] == 2) {
	$ach_mobs = '<img src="images/achievement/Silver-Mobsize.png" height="60" width="60" title="Silver Mob Size" />';
	}
	if($userp['ach_mobsize'] == 1) {
	$ach_mobs = '<img src="images/achievement/Bronze-Mobsize.png" height="60" width="60" title="Bronze Mob Size" />';
	}		
	echo '<div id="Achievement">'.$ach_mobs.'</div>';
	// Kills Achievement	
	if($userp['ach_kills'] == 4) {
	$ach_killer = '<img src="images/achievement/Diamond-Kills.png" height="60" width="60" title="Diamond Killer" />';
	}	
	if($userp['ach_kills'] == 3) {
	$ach_killer = '<img src="images/achievement/Gold-Kills.png" height="60" width="60" title="Gold Killer" />';
	}
	if($userp['ach_kills'] == 2) {
	$ach_killer = '<img src="images/achievement/Silver-Kills.png" height="60" width="60" title="Silver Killer" />';
	}
	if($userp['ach_kills'] == 1) {
	$ach_killer = '<img src="images/achievement/Bronze-Kills.png" height="60" width="60" title="Bronze Killer" />';
	}	
	echo '<div id="Achievement">'.$ach_killer.'</div>';
	// Hitman Achievement	
	if($userp['ach_hitman'] == 4) {
	$ach_hitm = '<img src="images/achievement/Diamond-Hitman.png" height="60" width="60" title="Diamond Hitman" />';
	}	
	if($userp['ach_hitman'] == 3) {
	$ach_hitm = '<img src="images/achievement/Gold-Hitman.png" height="60" width="60" title="Gold Hitman" />';
	}
	if($userp['ach_hitman'] == 2) {
	$ach_hitm = '<img src="images/achievement/Silver-Hitman.png" height="60" width="60" title="Silver Hitman" />';
	}
	if($userp['ach_hitman'] == 1) {
	$ach_hitm = '<img src="images/achievement/Bronze-Hitman.png" height="60" width="60" title="Bronze Hitman" />';
	}
	echo '<div id="Achievement">'.$ach_hitm.'</div>';
	// Boss Kills Achievement
	if($userp['ach_boss'] == 4) {
	$ach_boss_kill = '<img src="images/achievement/Diamond-Boss.png" height="60" width="60" title="Diamond Boss Killer" />';
	}	
	if($userp['ach_boss'] == 3) {
	$ach_boss_kill = '<img src="images/achievement/Gold-Boss.png" height="60" width="60" title="Gold Boss Killer" />';
	}
	if($userp['ach_boss'] == 2) {
	$ach_boss_kill = '<img src="images/achievement/Silver-Boss.png" height="60" width="60" title="Silver Boss Killer" />';
	}
	if($userp['ach_boss'] == 1) {
	$ach_boss_kill = '<img src="images/achievement/Bronze-Boss.png" height="60" width="60" title="Bronze Boss Killer" />';
	}
	echo '<div id="Achievement">'.$ach_boss_kill.'</div>';		
	?>  
    </div>
    <div id="EquipmentTab" style="display: none;">
    <div id="UserInventory">Equipment</div>
	<div style="max-height: 228px; overflow-y: scroll">
    <?php
	$select_guns = mysql_query("SELECT * FROM weapons WHERE owner_id='".$userp['id']."' AND owned > 0 ORDER BY id");
	while($gun = mysql_fetch_array($select_guns)) {
	if (mysql_num_rows($select_guns) > 0) {
		echo '<img src="images/'.$gun['image'].'.png" width="90" height="50" style="margin: 5px;" />';
		}
	}
	?>
	</div>
    </div>
    <div id="EstateTab" style="display: none;">
    <div id="UserInventory">Estate</div>
	<div style="max-height: 228px; overflow-y: scroll">
    <?php
	$select_prop = mysql_query("SELECT * FROM territory WHERE owner_id='".$userp['id']."' AND owned > 0 ORDER BY id");
	while($prop = mysql_fetch_array($select_prop)) {
	if (mysql_num_rows($select_guns) > 0) {
		echo '<img src="images/'.$prop['image'].'.png" width="90" height="50" style="margin: 5px;" />';
		}
	}
	?>
	</div>
    </div>      
    </td>
  </tr>
</table>
<!-- Comment Form -->
    <div id="BCBox">
	<div id="Page" align="center">Leave <?php echo $userp['username'] ?> A Comment: </div>
	<div align="center">
    <form action="javascript:void" method="post">
    <textarea class="BC" id="comment"></textarea> 
    <div align="left" style="margin-left: 5px;"> 
    <input type="submit" value="Comment" onClick="Comment(<?php echo $userp['id']?>)" />
    <input type="reset" />
    </div>
    </form> 
    </div>
    </div>
    <div id="CommentResult"></div>
    <!-- Comments -->
    <div id="Comments">
<?php
	$select_comments = mysql_query("SELECT * FROM comments WHERE wall_id='".$userp['id']."' ORDER BY id DESC LIMIT 25");
	while($comment = mysql_fetch_array($select_comments)) {
	$com_user_id = $comment['user_id'];
	if($id == $comment['wall_id']) {
		$delete = ' <span id="CommentDelete" style="float:right" onClick="DeleteComment('.$comment['id'].')">[Delete]</span>';
	}
	else {
		$delete= '';
	}
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$com_user_id."'");
while($user_info = mysql_fetch_array($select_users)) {
$com_id = $user_info['id'];
$com_name = $user_info['username'];
$com_image = $user_info['image'];
}
	echo 
	'<div id="Com'.$comment['id'].'">
	<table width="600" align="center" class="CommentBlock">
      <tr>
       <td width="40" valign="top"><img src="'.$com_image.'" width="40" height="40" /></td>
       <td width="548" valign="top">
       <div id="CommentName"><span onClick="ViewUser('.$com_id.')">'.$com_name.'</span> <span id="CommentTime">'.time_elapsed_string($comment['timestamp']).'</span> '.$delete.'</div>
       <div id="CommentText">'.$comment['comment'].'</div>   
       </td>
      </tr>
	 </table>
	 </div>';
	}
	?>
    </div>
    </div>
</div>
<div id="Mask" onClick="ClosePop();" title="Click To Close Popup!"></div>
<div class="PopUp" align="center"></div>
</body>
