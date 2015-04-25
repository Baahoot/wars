<?php session_start() ?>
<?php require 'connect.php' ?>
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
	$fetchstats = (int)strip_tags(rawurldecode($_GET['id']));
	$select_comments = mysql_query("SELECT * FROM comments WHERE wall_id='".$fetchstats."' ORDER BY id DESC LIMIT 25");
	while($comment = mysql_fetch_array($select_comments)) {
	if($id == $comment['wall_id']) {
		$delete = '<div id="CommentDelete" style="float:right" onClick="DeleteComment('.$comment['id'].')">[Delete]</div>';
	}
	else {
		$delete= '';
	}
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$comment['user_id']."'");
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
