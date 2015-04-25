<?php session_start ?>
<?php require 'connect.php' ?>
<?php
$users_new_name = trim(strip_tags($_POST['new_name']));
$new_name = preg_replace("/[^0-9a-zA-Z ]/", "", $users_new_name);
$new_name .= preg_replace('-', '', $users_new_name);
// Check Points
if($points < 10) {
$message = die('<span class="Fail">Error: You Don\'t Have 10 Boss Points!</i></span>');	
}
// Check Length
if (ctype_space($new_name)) {
$message = die('<span class="Fail">Error: Name Must Be At least 6 Characters Long!</i></span>');	
}
if(strlen($new_name) < 6) {
$message = die('<span class="Fail">Error: Name Must Be At least 6 Characters Long!</i></span>');
}
if(strlen($new_name) > 25) {
$message = die('<span class="Fail">Error: Name Can\'t Be More Than 25 Characters Long!</i></span>');
}
// Check other names
$check_names = mysql_query("SELECT * FROM users WHERE username='".$new_name."'");
if(mysql_num_rows($check_names) == 1) {
$message = die('<span class="Fail">Error: '.$new_name.' Is Already Taken!</i></span>');
}
if(mysql_num_rows($check_names) == 0) {
$message = '<span class="Success">Success: Your New Username Is '.$new_name.'!</i></span>';
$update_name = mysql_query("UPDATE users SET username='".$new_name."',points=(points-10) WHERE id=".$id."");
}
echo $message;
?>
