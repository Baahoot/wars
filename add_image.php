<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$image_url = mysql_real_escape_string($_POST['image']);
// Check if valid URL
if (filter_var($image_url, FILTER_VALIDATE_URL) === FALSE) {
$message = die('<span class="Fail">Error: Not A Valid URL!</span>');
}
// Check if Image already excists
$check_images = mysql_query("SELECT * FROM images WHERE owner_id=".$id." AND url='".$image_url."'");
if(mysql_num_rows($check_images) > 0) {
$message = die('<span class="Fail">Error: Image Already Excists!</span>');	
}
elseif(mysql_num_rows($check_images) == 0) {
$message = '<span class="Success">Success: Image Added To Your Images!</span>';	
$update = mysql_query("INSERT INTO images (owner_id,url) VALUES ('$id', '$image_url')");
}
$res = $update; 
echo $message;
?>
