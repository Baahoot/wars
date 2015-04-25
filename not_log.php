<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center "id="SubPage">User Notifications</div>
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
$select_log = mysql_query("SELECT * FROM notifications WHERE owner_id='".$id."' ORDER BY id DESC LIMIT 35");
if(mysql_num_rows($select_log) == 0) {
echo '<div align="center" class="Fail">..You Currently Have No Notifications..</div>';	
}
while($not = mysql_fetch_array($select_log)) {
// Notifications Vars
// Get User Info
$get_info = mysql_query("SELECT id,username,image FROM users WHERE id='".$not['user_id']."'");	
while($info = mysql_fetch_array($get_info)) {
$user_id = $info['id'];
$user_image = $info['image'];
$user_name = $info['username'];	
}
// Delete
$not_delete = '<div onClick="DeleteNot('.$not['id'].')" style="color: red; cursor: pointer; display: inline-block; float: right;">[Delete]</div>';
echo 
'<div id="NotBlock'.$not['id'].'">
<table width="600" align="center" id="BCBlock">
  <tr>
    <td width="50" valign="top"><img src="'.$user_image.'" width="50" height="50" /></td>
    <td width="538" valign="top">
    <div id="BCName" onClick="ViewUser('.$user_id.')">'.$user_name.'</div>
	<div id="BCTime">'.time_elapsed_string($not['timestamp']).'</div>
	<b><i>'.$not_delete.'</i></b>
	<div style="border-bottom: 1px dotted #FFFFFF; width: 100%;"></div>
	<span id="NotMessage'.$not['id'].'"><span style="color: #FFF000; font-style: italic;">'.$user_name.'</span> 
	<span style="color: #FFFFFF;">'.$not['message'].'</span>
	</span>
    </td>
  </tr>
</table>
</div>';
}
?>
