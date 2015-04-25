<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<script>window.location = "http://www.psychowars.net/app/";</script>'); } ?>
<?php
$broadcast = mysql_real_escape_string(strip_tags($_POST['broadcast']));
$timestamp = time();
if(strlen($broadcast) < 3) {
$message = '<div align="center" class="Fail">Error: You Need To Enter A Message!</div>';
$insert_bc = '';
}
else {
$message = '';
$insert_bc = mysql_query("INSERT INTO broadcast 
(user_id, message, timestamp) 
VALUES 
('$id', '$broadcast', '$timestamp')");
}
$res = $insert_bc;
echo $message;
?>
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
$select_bc = mysql_query("SELECT * FROM broadcast ORDER BY id DESC LIMIT 30");
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
if($user_admin == '1') {
$bc_message = '<div id="BCMessage" style="color: #FF0;">'.$bc['message'].'</div>';	
}
else {
$bc_message = '<div id="BCMessage">'.$bc['message'].'</div>';	
}
if($admin == 1) {
$bc_delete = '<span onClick="DeleteBC('.$bc['id'].')" style="color: red; cursor: pointer; display: inline-block;">[X]</span>';
}
else {
$bc_delete = '';
}
// BC hidden
if($bc['hidden'] == '1') {
echo '';
}
$smileys = array('(skull)','(king)','(weed)','(sad)');
$replacements = array(
	'<img src="images/smileys/Skull.gif" width="25" height="25" title="(skull)" />',
	'<img src="images/smileys/King.gif" width="25" height="25" title="(king)" />',
	'<img src="images/smileys/Weed.gif" width="25" height="25" title="(weed)" />',
	'<img src="images/smileys/Sad.gif" width="25" height="25" title="(sad)" />'
);
$smiley_message = str_replace($smileys,$replacements,$bc_message); 
// Show BC
if($bc['hidden'] == '0') {
echo	
'<table width="600" align="center" id="BCBlock">
  <tr>
    <td width="50" valign="top"><img src="'.$bc_image.'" width="50" height="50" /></td>
    <td width="538" valign="top">
    <div id="BCName" onClick="ViewUser('.$bc_id.')">'.$bc_name.'</div>
	<div id="BCTime">'.time_elapsed_string($bc['timestamp']).' 
	<span onClick="Reply(\''.$bc_name.'\')" style="color: #FFFFFF; cursor: pointer; display: inline-block;">[Reply]</span>
	'.$bc_delete.'
	</div>
	<div style="border-bottom: 1px dotted #FFFFFF; width: 100%;"></div>
	<span id="BroadMessage'.$bc['id'].'">'.$smiley_message.'</span>
    </td>
  </tr>
</table>';
	}
}	
?>
