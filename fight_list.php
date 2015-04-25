<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<div align="center "id="SubPage">Fight List: (<?php echo $location ?>)</div>
<div id="Achievements" align="center"></div>
<div id="AttackResults" align="center" class="PopUp"></div>
<?php
$select_users = mysql_query("SELECT * FROM users WHERE level>='".($level/2)."' AND level<(".($level+20).") AND id NOT IN ('".$id."') AND location='".$location."' ORDER BY RAND() LIMIT 25");
if(mysql_num_rows($select_users) == 0) {
die('<div align="center" class="Fail">..There Are Currently No Users In Your Range..</div>');
}
while($fight = mysql_fetch_array($select_users)) {
echo
'<table width="600" align="center" id="FightBlock">
  <tr>
    <td width="60">
	<img src="'.$fight['image'].'" width="60" height="60" style="border-radius: 6px; -moz-border-radius: 6px;"/>
	</td>
    <td width="374">
	<div id="FightUsername" onClick="ViewUser('.$fight['id'].')">'.$fight['username'].'</div><div id="FightLevel">Level: '.number_format($fight['level']).'</div>
	</td>
    <td width="150" align="center">
	<input type="submit" value="Attack" onClick="Attack('.$fight['id'].')" id="AttackButton" />
	</td>
  </tr>
</table>';	
}
?>
