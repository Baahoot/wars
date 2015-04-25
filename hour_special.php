<?php session_start() ?>
<?php require 'connect.php' ?>
<body bgcolor="#000000">
<?php
$result = mysql_query("SELECT * FROM users ORDER BY id");
while($row = mysql_fetch_array($result)) {
$total_pay = $row['income'] - $row['upkeep'];
$timestamp_hour = time() + 3600;
$inactive_time = strtotime('+1 week',$row['last_login']);
if(time() > $inactive_time) {
$income_add = '';	
echo '<div style="color: red;">'.$row['username'].' | <i>Inactive</i></div>';	
}
elseif(time() < $inactive_time) {
$income_add = mysql_query("UPDATE users SET cash=(cash+".$total_pay."),payment='".$timestamp_hour."',energy=(energy+".$row['e_income'].") WHERE id=".$row['id']."");
echo '<div style="color: green;">'.$row['username'].' | <i>Active</i></div>';
$res = $income_add;
	}
}
?>
</body>
