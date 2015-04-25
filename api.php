<?php require 'connect.php' ?>
<?php
$fetchstats = (int)strip_tags(rawurldecode($_GET['id']));
if ( isset ( $fetchstats ) )
{
	$fetchstats = mysql_real_escape_string($fetchstats);
	$sql = "SELECT * FROM users WHERE id='".$fetchstats."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) 
	{	
	$userp = mysql_fetch_array ( $res, MYSQLI_ASSOC ); 
	}
}
?>
<?php
$stats = array('id' => $userp['id'], 'name' => $userp['username'], 'level' => $userp['level'], 'image' => $userp['image'], 'url' => 'www.psychowars.net/app/user?id='.$userp['id'].'', 'income' => $userp['income'], 'wins' => $userp['wins'],);
echo json_encode($stats);
?>
