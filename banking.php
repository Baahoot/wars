<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$action = strip_tags($_GET['action']);
$money = strip_tags($_GET['money']);
$subtract = (10 / 100) * $money;
$fee = $money - $subtract;
// They Want To Deposit
if($action == 'deposit') {
if($money < 10000) {
$message = die('<span class="Fail">Error: Minimum Deposit Amount Of $10,000!</span>');	
$update = '';
}
if($cash < $money) {
$message = die('<span class="Fail">Error: You Don\'t Have $'.number_format($money).' To Deposit!</span>');	
$update = '';
}
elseif($cash >= $money) {
$message = '<span class="Success">Success: After A 10% Fee, You Deposited $'.number_format($fee).' Into Your Bank!</span>';	
$update = mysql_query("UPDATE users SET cash=(cash-".$money."),bank=(bank+".$fee.") WHERE id='".$id."'");
	}
}
// They Want To Deposit
if($action == 'withdrawal') {
if($money > $bank) {
$message = die('<span class="Fail">Error: You Don\'t Have $'.number_format($money).' To Withdrawal!</span>');	
$update = '';
}
if($money < 500) {
$message = die('<span class="Fail">Error: You Must Withdrawal Atleast $500!</span>');	
$update = '';
}
elseif($money <= $bank) {
$message = '<span class="Success">Success: You Withdrew $'.number_format($money).' From Your Bank!</span>';	
$update = mysql_query("UPDATE users SET cash=(cash+".$money."),bank=(bank-".$money.") WHERE id='".$id."'");
	}
}
echo $message;
$res = $update;	
?>
