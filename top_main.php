<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center "id="SubPage">Top Players: Overall</div>
<div align="left" style="width: 600px;">
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Highest Bounty</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY income DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">$'.number_format($top_stats['income'] * 10).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Highest Energy Income</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY e_income DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['e_income']).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Highest Level</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY level DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['level']).'</div>';	
}
?>
</div>
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Jobs Complete</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY missions DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['missions']).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Most Fights Won</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY wins DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['wins']).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Most Kills</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY kills DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['kills']).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Most Fights Lost</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY loses DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['loses']).'</div>';	
}
?>
</div>
<!-- Block End -->
<!-- Block Begins -->
<div id="TPBlock" align="center">
<div id="TPType">Bounties Caught</div>
<?php
$number = 1;
$top_players = mysql_query("SELECT * FROM users ORDER BY bounties DESC LIMIT 20");
while($top_stats = mysql_fetch_array($top_players)) {
echo
'<div id="TPName" onClick="ViewUser('.$top_stats['id'].')">'.$number++.'. '.substr($top_stats['username'],0,10).'..</div>
<div id="TPValue">'.number_format($top_stats['bounties']).'</div>';	
}
?>
</div>
<!-- Block End -->
</div>
