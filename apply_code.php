<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$code = mysql_real_escape_string($_POST['code']);
// Get The Codes
$select_codes = mysql_query("SELECT * FROM award_codes WHERE code='".$code."' LIMIT 1");
while($code_info = mysql_fetch_array($select_codes)) {
$code_award = $code_info['award'];
$code_message = $code_info['message'];
}
if(mysql_num_rows($select_codes) == 0) {
$message = die('<span class="Fail">Error: Invalid Award Code!</span>');
}
if(mysql_num_rows($select_codes) > 0) {
$message = '<span class="Success">Success: Award Code Valid! You Were Rewarded '.$code_message.'!</span>';
$update_stats = mysql_query("UPDATE users SET ".$code_award." WHERE id=".$id."");
$update_check = mysql_query("UPDATE award_check SET user_given=".$id.", time_given='".time()."' WHERE code='".$code."'");
$delete_code = mysql_query("DELETE FROM award_codes WHERE code='".$code."'");
}
echo '<div align="center">'.$message.'</div>';
?>
