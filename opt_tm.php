<?php session_start() ?>
<?php require 'connect.php' ?>
<!-- Optimized -->
<center>
<div style="width: 600px;" align="left">
<?php
$get_user_bonus = mysql_query("select b.id as id, b.username as username, b.image as image, b.income as income, b.last_login as last_login from mob a inner join users b on a.sent_id = b.id WHERE a.sender_id=".$id." ORDER BY b.income DESC LIMIT 9");
while($user_bonus_info = mysql_fetch_array($get_user_bonus)) {
$user_id = $user_bonus_info['id'];	
$user_b_income = $user_bonus_info['income'];	
$user_b_bounty = $user_b_income * 10;
$user_b_bonus = (5 / 100) * $user_b_bounty;

$total_b_bonus += $user_b_bonus;	
}
?>
<div id="Page">Optimized Top Mob Bonus: $<?php echo number_format($total_b_bonus) ?></div>
<?php
$get_users = mysql_query("select b.id as id, b.username as username, b.image as image, b.income as income, b.last_login as last_login from mob a inner join users b on a.sent_id = b.id WHERE a.sender_id=".$id." ORDER BY b.income DESC LIMIT 9");
while($user_info = mysql_fetch_array($get_users)) {
$user_id = $user_info['id'];	
$user_name = $user_info['username'];	
$user_image = $user_info['image'];	
$user_income = $user_info['income'];	
$user_bounty = $user_income * 10;
$user_bonus = (5 / 100) * $user_bounty;

$user_login = $user_info['last_login'];	
$total_bonus += $user_bonus;
echo 
'<div id="MyMobBlock">
<div id="MyMobName"><span title="'.$user_name.'">'.substr($user_name,0,10).'..</span></div>
<div align="center"><img src="'.$user_image.'" width="60" height="60" /></div>
<div class="Success" align="center">$'.number_format($user_bonus).'</div>
</div>';	
}
?>
<br /><br />
<div align="center"><input type="submit" onClick="OptimizeTopMob()" value="Optimize TopMob (10 boss Points)" /></div>
</div>
</center>
