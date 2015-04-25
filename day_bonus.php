<?php
require 'connect.php';
if(time() >= $daily_bonus) {
$rand = rand(1,5);
$time_add = strtotime('+1 day',time());	
// Energy
if($rand == 1) {
$rand_energy = rand(100,1000); 		
$message = '<span class="Success">Success: You Were Rewarded : <br />&#149; '.number_format($rand_energy).' Energy!</span>';
$update = mysql_query("UPDATE users SET energy=(energy+".$rand_energy."), daily_bonus='".$time_add."' WHERE id=".$id."");
}
if($rand == 2) {
$rand_points = rand(1,20); 		
$message = '<span class="Success">Success: You Were Rewarded : <br />&#149; '.number_format($rand_points).' Boss Points!</span>';
$update = mysql_query("UPDATE users SET points=(points+".$rand_points."), daily_bonus='".$time_add."' WHERE id=".$id."");
}
if($rand == 3) {
$rand_skills = rand(1,15); 		
$message = '<span class="Success">Success: You Were Rewarded : <br />&#149; '.number_format($rand_skills).' Skill Points!</span>';
$update = mysql_query("UPDATE users SET skill_points=(skill_points+".$rand_skills."), daily_bonus='".$time_add."' WHERE id=".$id."");
}
if($rand == 4) {
$rand_cash = rand(50000,25000000); 		
$message = '<span class="Success">Success: You Were Rewarded : <br />&#149; $'.number_format($rand_cash).' Cash!</span>';
$update = mysql_query("UPDATE users SET cash=(cash+".$rand_cash."), daily_bonus='".$time_add."' WHERE id=".$id."");
}
if($rand == 5) {
$rand_knuckles = rand(1,2); 		
$message = '<span class="Success">Success: You Were Rewarded : <br />&#149; '.$rand_knuckles.' Brass Knuckles!</span>';
$update = mysql_query("UPDATE users SET knuckles=(knuckles+".$rand_knuckles."), daily_bonus='".$time_add."' WHERE id=".$id."");
}
}
elseif(time() < $daily_bonus) {
$message = ('<span class="Fail">Error: You Already Collected The Daily Bonus!</span>');
}
echo 
'<table width="595">
  <tr>
	<td><img src="images/DailyBonus.png" /></td>
	<td valign="top">'.$message.'</td>
  </tr>
</table>';
?>
