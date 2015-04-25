<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<?php
$rand_code = sha1(mt_rand(1,9).time());
$item = strip_tags(mysql_real_escape_string($_GET['item']));
$amount = strip_tags(mysql_real_escape_string($_GET['amount']));
if(strlen($amount) < 1) {
	$message = die('<span class="Fail">Error: Amount Not Found!</span>');
}
// Cash
if($item == '1') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'cash=(cash+'.$amount.')';
	$new_message = '$'.number_format($amount);	
	$message = '<span class="Success">Success: $'.number_format($amount).' Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Skill Points
if($item == '2') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'skill_points=(skill_points+'.$amount.')';
	$message = '<span class="Success">Success: '.number_format($amount).' Skill Points Generated</div>';
	$new_message = number_format($amount).' Skill Points';	
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Boss Points
if($item == '3') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'points=(points+'.$amount.')';
	$new_message = number_format($amount).' Boss Points';	
	$message = '<span class="Success">Success: '.number_format($amount).' Boss Points Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// EXP
if($item == '4') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'exp=(exp+'.$amount.')';
	$new_message = number_format($amount).' EXP';
	$message = '<span class="Success">Success: '.number_format($amount).' EXP Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Health
if($item == '5') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'health=(health+'.$amount.')';
	$new_message = number_format($amount).' Health';
	$message = '<span class="Success">Success: '.number_format($amount).' Health Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Energy
if($item == '6') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'energy=(energy+'.$amount.')';
	$new_message = number_format($amount).' Energy';
	$message = '<span class="Success">Success: '.number_format($amount).' Energy Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Stamina
if($item == '7') {
	$new_code = substr($rand_code,0,5);
	$new_award = 'stamina=(stamina+'.$amount.')';
	$new_message = number_format($amount).' Stamina';
	$message = '<span class="Success">Success: '.number_format($amount).' Stamina Generated</div>';
	$update = mysql_query("INSERT INTO award_codes (code,award,message) VALUES ('$new_code','$new_award','$new_message')");
}
// Brass Knuckles
if($item == '8') {
	$message = die('<span class="Fail">Error: Knuckles Coming Soon!</span>');
}
echo $message;
?>
