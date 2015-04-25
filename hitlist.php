<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div id="Page" align="center">Hitlist</div>
<div id="Achievements" align="center"></div>
<div id="AttackResults"></div>
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
$hitlist_users = mysql_query("SELECT * FROM hitlist ORDER BY id DESC");
if(mysql_num_rows($hitlist_users) == 0) {
die('<div align="center" class="Fail">..There Are Currently No Users On The Hitlist..</div>');
}
while($hitlist = mysql_fetch_array($hitlist_users)) {
//Select listed info
$select_listed = mysql_query("SELECT id,username,image FROM users WHERE id='".$hitlist['listed_id']."'");
while($user_info = mysql_fetch_array($select_listed)) {
$listed_id = $user_info['id'];
$listed_name = $user_info['username'];
$listed_image = $user_info['image'];
}
//Select lister info
$select_lister = mysql_query("SELECT id,username,image FROM users WHERE id='".$hitlist['lister_id']."'");
while($user_info = mysql_fetch_array($select_lister)) {
$lister_id = $user_info['id'];
$lister_name = $user_info['username'];
$lister_image = $user_info['image'];
}
echo
'<table width="600" align="center" id="BountyBlock">
  <tr>
    <td width="50"><img src="'.$listed_image.'" width="50" height="50" /></td>
    <td width="180">
    <div id="BountyName" onClick="ViewUser('.$hitlist['listed_id'].')">'.$listed_name.'</div><div id="BountySet" onClick="ViewUser('.$hitlist['lister_id'].')">Set By: '.$lister_name.'</div>
    </td>
    <td width="115"><div id="HitlistBounty">$'.number_format($hitlist['amount']).'</div></td>
    <td width="171"><div id="HitlistTime">'.time_elapsed_string($hitlist['timestamp']).'</div></td>
    <td width="60" align="center">
	<input type="submit" value="Attack" onClick="AttackHitlist('.$hitlist['listed_id'].')" id="AttackButton" />
	</td>
  </tr>
</table>';	
}
?>
