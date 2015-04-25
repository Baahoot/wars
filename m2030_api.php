<?php
$file = file_get_contents('http://mobsters2030.com/mobsters/play/MyStats.php?id=679');
json_decode($file, true);
$v = json_decode($file, true);
echo $v;
?>
