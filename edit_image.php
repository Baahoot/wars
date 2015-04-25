<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$image_id = mysql_real_escape_string($_GET['id']);
$select_image = mysql_query("SELECT * FROM images WHERE owner_id=".$id." AND id=".$image_id."");
if(mysql_num_rows($select_image) == 0) {
$message = die('<span class="Fail">Error: Image Doesn\'t Excist!</span>');	
}
else {
while($i = mysql_fetch_array($select_image)) {
$i_url = $i['url'];	
}
$message = '<span class="Success">Success: Image Changed!</span>';	
$update = mysql_query("UPDATE users SET image='".$i_url."' WHERE id=".$id."");
}
$res = $update;
echo $message;
?>
