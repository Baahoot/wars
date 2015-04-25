	<?php session_start() ?>
	<?php require 'connect.php' ?>
	<div id="UserInventory">Broadcasts</div>  
    <div align="center">
    <form action="javascript:void" method="post" id="BCForm">
    <textarea id="bc_message" class="BC"></textarea>
    <input type="submit" value="Post" onClick="FBroadcast()" />
    <input type="reset" />
    </form>
    </div>
	<div align="center" id="Broadcasts">
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
