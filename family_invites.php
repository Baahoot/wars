<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<?php $check_invites = mysql_query("SELECT * FROM family_invites WHERE sent_id='".$id."'"); ?>
<div align="center "id="SubPage">Invites Received: <?php echo number_format(mysql_num_rows($check_invites)) ?></div>
<div id="MobResults"></div>
<div align="Center">
<div align="left" style="width: 600px;">
<div id="FamiName">Family Name</div>
<div id="FamiName">Owner</div>
<div id="FamiName">Action</div>
<?php
$select_invites = mysql_query("SELECT * FROM family_invites WHERE sent_id='".$id."'");
while($invite = mysql_fetch_array($select_invites)) {
$sender_id = $invite['sender_id'];
$family_id = $invite['family_id'];
$timestamp = $invite['timestamp'];
//Select user info
	$select_member = mysql_query("SELECT * FROM users WHERE id='".$sender_id."'");
	while($member_info = mysql_fetch_array($select_member)) {
	$member_id = $member_info['id'];
	$member_name = $member_info['username'];
	$member_image = $member_info['image'];
}
// API End
$get_family = mysql_query("SELECT * FROM family WHERE id=".$family_id."");
while($family = mysql_fetch_array($get_family)) {
$family_name = $family['name'];
}
echo 
'<div id="FamBlock">
<div id="FamiName" onClick="ViewFamily('.$family_id.')">'.$family_name.'</div>
<div id="FamOwner" onClick="ViewUser('.$member_id.')">'.$member_name.'</div>
<div id="FamAction">
<span class="Success" style="cursor: pointer;" onClick="AcceptFam('.$family_id.')">[Accept]</span> 
<span class="Fail" style="cursor: pointer;" onClick="DeclineFam('.$family_id.')">[Decline]</span>
</div>
</div>';
}
?>
</div>
</div>
