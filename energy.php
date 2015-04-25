<?php
require 'connect.php';
if(time() >= $daily_energy) {
$time_add = strtotime('+1 day',time());	
$message = '<span class="Success">Success: You Received: <br />&#149; 200 Energy!</span>';
$update = mysql_query("UPDATE users SET energy=(energy+200), daily_energy='".$time_add."' WHERE id=".$id."");
}
elseif(time() < $daily_energy) {
$message = '<span class="Fail">Error: You Already Collected The 200 Energy Bonus!</span>';
}
echo
'<table width="595">
  <tr>
	<td><img src="images/200Energy.png" /></td>
	<td valign="top">'.$message.'</td>
  </tr>
</table>';
?>
