<?php
// API
$user_id = $_GET['id'];
$file = file_get_contents('http://www.psychowars.net/app/api.php?id='.$user_id.'');
json_decode($file, true);
$v = json_decode($file, true);
$vname = $v['name'];
$vpic = $v['image'];
$vlink = $v['url'];
$vid = $v['id'];
$vlevel = $v['level'];
$vincome = $v['income'];
// API END
// Income Equation
if($vincome < 10000) {
	$vbounty = '10000';
}
else {
	$vbounty = $vincome * 10;
}
// API End	
?>
