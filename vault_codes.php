<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div id="Page" align="center">Attempted Vault Codes</div>
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
$select_vault = mysql_query("SELECT * FROM vault_codes ORDER BY id DESC");
while($v_info = mysql_fetch_array($select_vault)) {
$vault_code = $v_info['code'];
$vault_time = $v_info['timestamp'];
$num = 1;
echo '<div class="SuccessTMC">'.time_elapsed_string($vault_time).' | Code :: '.$vault_code.'</div>';
}
?>
</center>
