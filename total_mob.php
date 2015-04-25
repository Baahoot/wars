<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center "id="SubPage">Total Mob: <?php echo number_format($mob_size) ?></div>
<div id="MobResults"></div>
<div align="Center">
<div align="left" style="width: 600px;">
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
$select_mob = mysql_query("SELECT * FROM mob WHERE sent_id='".$id."'");
while($my_mob = mysql_fetch_array($select_mob)) {
$sender_id = $my_mob['sender_id'];
$mob_time = $my_mob['timestamp'];
//Select user info
$select_users = mysql_query("SELECT * FROM users WHERE id='".$sender_id."'");
while($user_info = mysql_fetch_array($select_users)) {
$mob_id = $user_info['id'];
$mob_name = $user_info['username'];
$mob_image = $user_info['image'];
}
echo 
'<div id="MyMobBlock">
<div id="MyMobName">
<span onClick="ViewUser('.$mob_id.')" title="'.$mob_name.'">'.substr($mob_name,0,10).'..</span>  
<span class="Fail" style="cursor: pointer;" onClick="RemoveMob('.$mob_id.')">[X]</span>
</div>
<div align="center"><img src="'.$mob_image.'" width="60" height="60" /></div>
<div id="MyMobTime">Added: '.time_elapsed_string($mob_time).'</div>
<div class="Success" align="Center" style="cursor: pointer;" onClick="Promote('.$mob_id.')">[Promote]</div>
</div>';
}
?>
</div>
</div>
