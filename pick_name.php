<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$users_new_name = strip_tags($_POST['name']);
$new_name = preg_replace("/[^0-9a-zA-Z -]/", "", $users_new_name);
$check_names = mysql_query("SELECT * FROM users WHERE username='".$new_name."'");
if(strlen($new_name) < 6) {
$message = die('<span class="Fail">Error: Name Must Be At least 6 Characters Long!</i></span>');
}
if(mysql_num_rows($check_names) == 0) {
$message = '<span class="Success">Success: Welcome '.$new_name.'!</i></span>';
$refresh = '<script>window.location = "http://www.psychowars.net/app/";</script>';
$update_name = mysql_query("UPDATE users SET username='".$new_name."' WHERE id=".$id."");
}
if(strlen($username) > 0) {
$message = die('<script>window.location = "http://www.psychowars.net/app/";</script>');
}
if(mysql_num_rows($check_names) == 1) {
$message = die('<span class="Fail">Error: '.$new_name.' Is Already Taken!</i></span>');
}
echo $message.$refresh;
?>
