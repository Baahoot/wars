<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<?php
$user_code = ($_GET['code']);
$timestamp = time();
// Vault Info
$select_vault = mysql_query("SELECT * FROM vault WHERE code='".$user_code."' AND active='1' LIMIT 1");
$v_info = mysql_fetch_array($select_vault);
$vault_code = $v_info['code'];
$vault_money = $v_info['amount'];
// New Amount
$math_amount = (25/100) * $vault_money;
$new_amount = (int)($math_amount + $vault_money);
$new_code = rand(0,9).''.rand(0,9).''.rand(0,9);
// Checking
if(strlen($user_code) < 3) {
	$message = die('<div class="SuccessTMC"><span class="Fail">Error: You Must Enter A Full Code!</span></div><br />');
}
if(mysql_num_rows($select_vault) == 1) {
$message = '<span class="Success">Success: You Cracked The Vault Claiming $'.number_format($vault_money).' And 10 Boss Points!</span>';
$update_v = mysql_query("UPDATE vault SET active='0',winner_id=".$id.",timestamp=".$timestamp." WHERE code=".$user_code."");
$update_u = mysql_query("UPDATE users SET points=(points+10),cash=(cash+".(int)$vault_money.") WHERE id=".$id."");
$insert = mysql_query("INSERT INTO vault (code,amount,active) VALUES ('$new_code','$new_amount','1')");
$delete = mysql_query("DELETE FROM vault_codes");
}
else {
$message = '<span class="Fail">Error: Vault Code Doesn\'t Match!</span>';	
$insert_code = mysql_query("INSERT INTO vault_codes (code,timestamp) VALUES ('$user_code',$timestamp)");
}
echo '<div class="SuccessTMC">'.$message.'</div><br />';
?>
</center>
