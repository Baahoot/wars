<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<?php
$select_vault = mysql_query("SELECT amount FROM vault WHERE active='1' LIMIT 1");
$v_info = mysql_fetch_array($select_vault);
$vault_money = $v_info['amount'];
?>
<div id="Page" align="center">Vault :: Try To Crack The Safe! (Current Vault: $<?php echo number_format($vault_money) ?>)</div>
<center><img src="images/Vault.png" /></center>
<div id="SafeResults"></div>
<form action="javascript:void" method="POST">
<input type="text" maxlength="1" id="vault1" style="width: 25px; text-align: center;" />
<input type="text" maxlength="1" id="vault2" style="width: 25px; text-align: center;" />
<input type="text" maxlength="1" id="vault3" style="width: 25px; text-align: center;" />
<input type="submit" value="Crack Vault" onClick="CrackVault()" />
</form>
<br /><br />
<center>
<div id="Loading" style="cursor: pointer;" onClick="ViewVCodes()">View Attempted Codes</div>
<?php 
function time_elapsed_string($ptime) {
    $timestamp = time() - $ptime;
    
    if ($timestamp < 1) {
        return '1 second ago';
    }
    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
        $d = $timestamp / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's ago' : ' ago');
        }
    }
}
// Vault Info
$select_vault = mysql_query("SELECT * FROM vault WHERE active='0' ORDER BY id DESC LIMIT 1");
$v_info = mysql_fetch_array($select_vault);
$vault_code = $v_info['code'];
$vault_winner = $v_info['winner_id'];
$vault_time = $v_info['timestamp'];
$vault_money = $v_info['amount'];
// User Info
$get_user = mysql_query("SELECT username FROM users WHERE id=".$vault_winner." LIMIT 1");
$user_i = mysql_fetch_array($get_user);
$winner_name = $user_i['username'];
// Message
if(mysql_num_rows($select_vault) == 0) {
$message = '<div class="SuccessTMC">The Vault Has Not Been Cracked Yet!</div>';
}
else {
$message = '<div class="SuccessTMC">Vault Last Opened By '.$winner_name.' Claiming $'.number_format($vault_money).' '.time_elapsed_string($vault_time).'!</div>';	
}
echo $message;
?>
</center>
