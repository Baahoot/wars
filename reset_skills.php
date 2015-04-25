<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$reset_skills = ($level * 3) + 5;
if($points < 30) {
$message = die('<span class="Fail">Error: You Need 30 Boss Points To Do A Skill Reset!</span>');
}
else {
$reset = mysql_query("UPDATE users SET attack='1',defense='1',health='100',max_health='100',energy='100',max_energy='100',stamina='5',max_stamina='5' WHERE id=".$id."");	
$update = mysql_query("UPDATE users SET skill_points='".$reset_skills."',points=(points-30) WHERE id=".$id."");
$message = '<span class="Success">Success: You Reset Your Skill Points!</span>';
}
echo $message;
?>
