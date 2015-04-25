<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center "id="SubPage">Fight Log</div>
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
$select_log = mysql_query("SELECT * FROM fight_log WHERE owner_id='".$id."' ORDER BY id DESC LIMIT 30");
if(mysql_num_rows($select_log) == 0) {
echo '<div align="center" class="Fail">..You Currently Have No Fight Logs..</div>';	
}
while($log = mysql_fetch_array($select_log)) {
echo '<div align="center" id="LogBlock"><div style="font-size: 15px; color: #FFFFFF; font-weight: bold;">'.time_elapsed_string($log['timestamp']).'</div>'.$log['messages'].'</div>';
}
?>
