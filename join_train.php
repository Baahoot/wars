<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$time = strtotime('+1 day',time());
$select_train = mysql_query("SELECT * FROM addtrain WHERE user_id=".$id."");
if(mysql_num_rows($select_train) > 0) {
	$message = die('<div id="FightResults"><span class="Fail">Error: You\'re Already On The Add Train!</span></div>');
}
else {
	$message = '<span class="Success">Success: You Are Now Riding The Add Train! Check Back In 24 Hours To Ride Again!</span>';
	$topmob_add = mysql_query("INSERT INTO addtrain 
							  (user_id, timestamp) 
							  VALUES 
							  ('$id', '$time')");
}
$res = $topmob_add;
echo '<div id="FightResults">'.$message.'</div>';
?>
