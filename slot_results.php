<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$bet = (int)strip_tags(rawurldecode($_GET['bet']));
if ( isset ( $bet ) )
{
	$bet = mysql_real_escape_string($bet);
	$sql = "SELECT * FROM slots_pay WHERE bet='".$bet."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) {
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
	else { 
		die('<div class="Fail">Error: Cheaters Can\'t Play! Come Back When You Want To Gamble By The Rules!</div>');
	}
}
?>
<?php
// Checking Clicks
$now = time();
if ($_SESSION['click'] > ($now-0.05)) { 
$message = 
die('<img src="images/SlotUnknown.png" /> <img src="images/SlotUnknown.png" /> <img src="images/SlotUnknown.png" /> <div class="Fail">Error: Don\'t Break The Slot Machines!</div>');
}
$_SESSION['click'] = $now;
// Bet Info
$bet_cost = $userp['bet'];
$bet_multiply = $userp['multiply'];
$bet_exp = $userp['exp'];
$bet_win = $bet_cost * $bet_multiply;
// Slots
$slot1 = rand(1,4);
$slot2 = rand(1,4);
$slot3 = rand(1,4);
// Slot 1 Info
$sel_slot1 = mysql_query("SELECT * FROM slots WHERE id=".$slot1."");
while($slot1_info = mysql_fetch_array($sel_slot1)) {
$slot1_name = $slot1_info['name'];	
$slot1_image = $slot1_info['image'];
}
// Slot 2 Info
$sel_slot2 = mysql_query("SELECT * FROM slots WHERE id=".$slot2."");
while($slot2_info = mysql_fetch_array($sel_slot2)) {
$slot2_name = $slot2_info['name'];	
$slot2_image = $slot2_info['image'];
}
// Slot 3 Info
$sel_slot3 = mysql_query("SELECT * FROM slots WHERE id=".$slot3."");
while($slot3_info = mysql_fetch_array($sel_slot3)) {
$slot3_name = $slot3_info['name'];	
$slot3_image = $slot3_info['image'];
}
// Slots Array
$slots = array($slot1,$slot2,$slot3);
// Seeing if the slots array is equal
if ($cash < $bet_cost) {
$message = 
die('<img src="images/SlotUnknown.pn" title="'.$slot1_name.'" /> <img src="images/SlotUnknown.png" title="'.$slot2_name.'" /> <img src="images/SlotUnknown.png" title="'.$slot3_name.'" /> <div class="Fail">Error: You Don\'t Have $'.number_format($bet_cost).'!</div>');	
}
if(count(array_unique($slots)) === 1) {
$message = '<span class="Success">Success: You Won $'.number_format($bet_win).'! You Gained '.$bet_exp.' EXP!</span>';
$update = mysql_query("UPDATE users SET cash=(cash+".$bet_win."),exp=(exp+".$bet_exp.") WHERE id=".$id."");
}
else {
$message = '<span class="Fail">Error: You Lost $'.number_format($bet_cost).'! Better Luck Next Time!</span>';
$update = mysql_query("UPDATE users SET cash=(cash-".$bet_cost.") WHERE id=".$id."");
}
echo 
'<img src="images/Slot'.$slot1_image.'.png" title="'.$slot1_name.'" /> 
<img src="images/Slot'.$slot2_image.'.png" title="'.$slot2_name.'" />  
<img src="images/Slot'.$slot3_image.'.png" title="'.$slot3_name.'" />';
echo '<br />'.$message;
?>
