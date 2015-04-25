<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<div align="center" id="EditImage"></div>
<?php
$user_images = mysql_query("SELECT * FROM images WHERE owner_id=".$id." ORDER BY id DESC");
while($i = mysql_fetch_array($user_images)) {
$i_id = $i['id'];
$i_url = $i['url']; 	
echo 
'<div class="ImageB">
<center><img src="'.$i_url.'" width="50" height="50" /></center>
<div class="ImageOptions">
<span onClick="ChangeImage('.$i_id.')">Activate</span> 
<span onClick="RemoveImage('.$i_id.')" style="color: red;">[X]</span>
</div>
</div>';
}
?>
