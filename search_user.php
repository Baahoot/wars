<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$searchs_name = mysql_real_escape_string($_POST['users_name']);
$search_name = preg_replace("/[^0-9a-zA-Z ]/", "", $searchs_name);
$find_user = mysql_query("SELECT id,username,level,image FROM users WHERE username LIKE '%".$search_name."%' ORDER BY id");
while($userp = mysql_fetch_array($find_user)) {
$user_name = $userp['username'];	
$user_id = $userp['id'];	
$user_level = $userp['level'];	
$user_image = $userp['image'];
if(strlen($search_name) < 2) {
	die('<span class="Fail">Error: You Must Enter At Least 2 Characters!</span>');
}
if(mysql_num_rows($find_user) > 0) {
echo 
'<table class="SearchBlock" align="center">
  <tr>
	<td valign="middle" class="SearchImage"><img src="'.$user_image.'" width="60" height="60" /></td>
	<td valign="middle" class="SearchName">'.$user_name.'</td>
	<td valign="middle" class="SearchLevel">Level: '.number_format($user_level).'</td>
	<td valign="middle" class="SearchInvite">
	<input type="submit" value="Invite" onClick="MobInvite('.$user_id.')" />
	<input type="submit" value="View" onClick="ViewUser('.$user_id.')" />
	</td>
	</div>
	</td>
  </tr>
</table>';	
}
else {
	die('<span class="Fail">Error: No Queries Match!</span>');
}
}
?>
