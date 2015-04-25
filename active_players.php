<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<?php
$active_time = strtotime('-10 minutes',time());
$select_active = mysql_query("SELECT * FROM users WHERE last_active > ".$active_time."");
$number = 1;
while($info = mysql_fetch_array($select_active)) {
$users_name = $info['username'];
echo '<div style="font-size: 17px; color: #FFFFFF; text-align: left">'.$number++.'. '.$users_name.'</span>';
}
?>
