<?php session_start() ?>
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
	else
	{ 
	exit;
	}
}
else
{
	exit;
}
?>
<div id="FightResults" align="center" style="width: 600px; border: 1px solid #FFFFFF; background-color: #333333;">
<div style="font-size: 15px; color: #FFFFFF; font-weight: bold;" align="center">
Add <?php echo $userp['username'] ?> To The Hitlist For $
<input type="text" id="SetBounty" value="<?php echo $userp['income']*10 ?>" onKeyUp="isNumber(this)" />
<input type="submit" Value="Set Bounty" onClick="AddToHitlist(<?php echo $userp['id'] ?>)" />
</div>
</div>
