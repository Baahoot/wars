<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1){ die('<span class="Fail">You Don\'t Have Permission To Be Here!</span>');} ?>
<?php
$comment_id = mysql_real_escape_string(strip_tags($_GET['comment_id']));
$check = mysql_query("SELECT * FROM broadcast WHERE id='".$comment_id."' AND hidden='1'");
if(mysql_num_rows($check == 0)) {
$message = die('<span class="Fail">Error: Message Already Hidden!</span>');
$delete = '';
}
else {
$message = '<span class="Success">Success: Message Hidden!</span>';
$delete = mysql_query("UPDATE broadcast SET hidden='1' WHERE id=".$comment_id."");
}
echo $message;
$res = $delete;
?>
