<?php session_start() ?>
<?php require 'connect.php' ?>
<?php $check_invites = mysql_query("SELECT * FROM mob_invites WHERE sent_id='".$id."'"); ?>
<div align="center "id="SubPage">Invites Received: <?php echo number_format(mysql_num_rows($check_invites)) ?></div>
<div id="Achievements" align="center"></div>
<div id="MobResults"></div>
<div align="Center">
<div align="left" style="width: 600px;">
<?php
$select_invites = mysql_query("SELECT * FROM mob_invites WHERE sent_id='".$id."'");
while($invite = mysql_fetch_array($select_invites)) {
$sender_id = $invite['sender_id'];
$timestamp = $invite['timestamp'];
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$sender_id."'");
while($user_info = mysql_fetch_array($select_users)) {
$mob_id = $user_info['id'];
$mob_name = $user_info['username'];
$mob_image = $user_info['image'];
}
if($sender_id == '0') {
$delete = mysql_query("DELETE FROM mob_invites WHERE sender_id='0'");	
$delete1 = mysql_query("DELETE FROM mob_invites WHERE sent_id='0'");	
}
else {
echo 
'<div id="MyMobBlock">
<div id="MyMobName" onClick="ViewUser('.$mob_id.')">'.$mob_name.'</div>
<div align="center"><img src="'.$mob_image.'" width="60" height="60" /></div>
<div align="center">
<span class="Success" style="cursor: pointer;" onClick="AcceptMob('.$mob_id.')">[Accept]</span> 
<span class="Fail" style="cursor: pointer;" onClick="DeclineMob('.$mob_id.')">[Decline]</span>
</div>
</div>';
	}
}
?>
</div>
</div>
