<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin == '0') { die('Error: You Don\'t Have Access To Be Here!'); } ?>
<?php
$number = 1;
$select_codes = mysql_query("SELECT * FROM award_codes");
while($award = mysql_fetch_array($select_codes)) {
$award_message = $award['message'];
$award_code = $award['code'];
echo '<div style="width: 400px; background-color: #333333; border-radius: 6px; border: 1px solid #FFFFFF; margin-top: 15px; padding: 5px; color: green;">'.$number++.'. Code: <input type="text" readonly="yes" value="'.$award_code.'" />  Award: '.$award_message.'<br /></div>';
}
?>
