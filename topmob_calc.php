<?php session_start() ?>
<?php require 'connect.php' ?>
<center>
<div style="width: 600px;" align="left">
<?php
$get_c_user_bonus = mysql_query("select b.id as id, b.username as username, b.image as image, b.income as income, b.last_login as last_login from topmob a inner join users b on a.mob_id = b.id WHERE a.owner_id=".$id." ORDER BY b.income DESC LIMIT 9");
while($user_bonus_info = mysql_fetch_array($get_c_user_bonus)) {
$user_id = $user_bonus_info['id'];	
$user_c_income = $user_bonus_info['income'];	
$user_c_bounty = $user_c_income * 10;
$user_c_bonus = (5 / 100) * $user_c_bounty;
$total_c_bonus += $user_c_bonus;	
}
?>
<div id="Page">Current Top Mob Bonus: $<?php echo number_format($total_c_bonus) ?> | <span class="Success" onClick="SearchTopMob()" style="cursor: pointer;">[Check Mob]</span></div>
<?php
$gets_users = mysql_query("select b.id as id, b.username as username, b.image as image, b.income as income, b.last_login as last_login from topmob a inner join users b on a.mob_id = b.id WHERE a.owner_id=".$id." ORDER BY b.income DESC LIMIT 9");
while($users_info = mysql_fetch_array($gets_users)) {
$users_id = $users_info['id'];	
$users_name = $users_info['username'];	
$users_image = $users_info['image'];	
$users_income = $users_info['income'];	
$users_bounty = $users_income * 10;
$users_bonus = (5 / 100) * $users_bounty;
$users_login = $users_info['last_login'];	
$totals_bonus += $users_bonus;
echo 
'<div id="MyMobBlock">
<div id="MyMobName"><span title="'.$users_name.'">'.substr($users_name,0,10).'..</span></div>
<div align="center"><img src="'.$users_image.'" width="60" height="60" /></div>
<div class="Success" align="center">$'.number_format($users_bonus).'</div>
</div>';	
}
?>
</div>
</center>
<br />
<div id="OptResults"></div>
