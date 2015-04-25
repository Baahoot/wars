<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$wall_id = strip_tags($_GET['id']);
$comment = mysql_real_escape_string(strip_tags($_POST['comment']));
$timestamp = time();
if(strlen($comment) < 3) {
$message = '<div class="Fail">Error: Message To Small!</div>';	
}	
else {
$message = '<div class="Success">Success: You Left A Comment!</div>';	
$insert = mysql_query("INSERT INTO comments (wall_id, user_id, comment, timestamp) VALUES ('$wall_id', '$id','$comment','$timestamp')");
$res = $insert;
}
echo $message;
?>
