<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<body>
<?php
$difference = $travel_time - time();
$minutes = floor($difference/60);
$seconds = floor($difference%60);
if(time() < $travel_time) {
$message = '<span class="Fail">Travel Again In: '.$minutes.' Minutes | '.$seconds.' Seconds</span>';
}
else {
$message = '<span class="Success">You Can Now Travel!</span>';	
}
?>
<div align="center "id="SubPage">Location: (<?php echo $location ?>) [<?php echo $message ?>]</div>
<div align="left">
<div id="TravelBlock"><img src="images/Chicago.png" onClick="Travel(1)" /></div>
<?php if($level < 10) {
echo '<div id="TravelBlock"><img src="images/Locked-New-York.png" /></div>';
}
else {
echo '<div id="TravelBlock"><img src="images/New-York.png" onClick="Travel(2)" /></div>';	
}
?>
<?php if($level < 20) {
echo '<div id="TravelBlock"><img src="images/Locked-Las-Vegas.png" /></div>';
}
else {
echo '<div id="TravelBlock"><img src="images/Las-Vegas.png" onClick="Travel(3)" /></div>';	
}
?>
</div>
