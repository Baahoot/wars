<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<body>
<div align="center">
<?php
$check_family = mysql_query("SELECT * FROM family_members WHERE mob_id=".$id."");
if(mysql_num_rows($check_family) == 0) {
$message = 
'<div id="FamilyResults"></div>
<span class="FormText">Start A Family :: </span>
<span class="FormText">[Name] </span>
<input type="text" id="FamName" maxlength="20" placeholder="Family Name" />
<span class="FormText">[Tags] </span>
<input type="text" id="FamTag" maxlength="6" placeholder="Family Tags" size="10" />
<input type="Submit" value="Create" onClick="CreateFamily()" />';	
}
elseif(mysql_num_rows($check_family) > 0) {
while($family_info = mysql_fetch_array($check_family)) {
$my_fam_id = $family_info['family_id'];
}
$find_fam_id = mysql_query("SELECT * FROM family WHERE id=".$my_fam_id."");
while($find_id = mysql_fetch_array($find_fam_id)) {
$my_fam_name = $find_id['name'];	
$my_fam_tags = $find_id['tags'];
$message = 
'<span class="FormText">
You\'re Currently In The Family: '.$my_fam_name.' ['.$my_fam_tags.']
<span onclick="ViewFamily('.$my_fam_id.')" style="cursor: pointer;">(View)</span>
</div>';	
	}
}
echo '<div id="FightResults" style="padding-bottom: 2px; padding-top: 2px;">'.$message.'</div>';
?>
<?php
// Select All Families
$select_families = mysql_query("SELECT * FROM family ORDER BY id");
while($family = mysql_fetch_array($select_families)) {
$family_id = $family['id'];	
$family_owner = $family['owner_id'];	
$family_name = $family['name'];
$family_tags = $family['tags'];
$family_time = $family['timestamp'];
// Family Size
$total_members = mysql_query("SELECT * FROM family_members WHERE family_id=".$family_id." ORDER BY id DESC");
if(mysql_num_rows($total_members) == 0) {
	$family_members = '1';
}
else {
	$family_members	= mysql_num_rows($total_members);
}
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$family_owner."'");
while($user_info = mysql_fetch_array($select_users)) {
$user_admin = $user_info['admin'];	
$fam_id = $user_info['id'];
$fam_name = $user_info['username'];
$fam_image = $user_info['image'];
}
echo 
'<div id="FamilyBlock" align="left">
<div id="FamilyName">
'.$family_name.' 
<div id="ViewFamily" onClick="ViewUser('.$fam_id.')">(View Owner)</div>
<div id="ViewFamily" onClick="ViewFamily('.$family_id.')">(View Family)</div>
</div>
<div id="FamilyInfo">Owner ['.$fam_name.'] :: Tags ['.$family_tags.'] :: Total Members ['.$family_members.']</div> 
<div id="FamilyMessage">'.$family_message.'</div>
</div>';
}
?>   
</div>
