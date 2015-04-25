<?php session_start() ?>
<?php require 'connect.php' ?>
<body bgcolor="#000000">
<?php
$count = 1;
$result = mysql_query("SELECT * FROM users ORDER BY id");
echo '<div style="color: #FFFFFF;">Total Users: '.mysql_num_rows($result).'</div>';
while($row = mysql_fetch_array($result)) {
$total_pay = $row['income'] - $row['upkeep'];
$timestamp_hour = time() + 3600;
$inactive_time = strtotime('+1 week',$row['last_login']);
if(time() > $inactive_time) {
echo '<div style="color: red;">'.$row['username'].' Income: $'.number_format($row['income']).' | <i>Inactive</i></div>';	
}	
elseif(time() < $inactive_time) {
echo '<div style="color: green;">'.$count++.'.'.$row['username'].' Income: $'.number_format($row['income']).' | E Income: '.$row['e_income'].' | <i>Active</i></div>';
	}
}
?>
</body>
