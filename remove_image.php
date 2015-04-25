<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$image_id = mysql_real_escape_string($_GET['id']);
$select_image = mysql_query("SELECT * FROM images WHERE owner_id=".$id." AND id=".$image_id."");
$image_info = mysql_fetch_array($select_image);
if(mysql_num_rows($select_image) == 0) {
$message = die('<span class="Fail">Error: Image Doesn\'t Excist!</span>');	
}
if($image == $image_info['url']) {
$message = die('<span class="Fail">Error: This Is Your Current Image!</span>');		
}
else {
$message = '<span class="Success">Success: This Image Removed!</span><br /><center><img src="'.$image_info['url'].'" width="60" height="60" /></center>';	
$update = mysql_query("DELETE FROM images WHERE owner_id=".$id." AND url='".$image_info['url']."'");
}
echo $message;
?>
