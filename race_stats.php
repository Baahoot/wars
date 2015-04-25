<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<body bgcolor="#000000">
<?php
$count = 1;
$result = mysql_query("SELECT * FROM hitlist_race ORDER BY bounties DESC");
echo '<div style="color: #FFFFFF;">Total Users: '.mysql_num_rows($result).'</div>';
while($row = mysql_fetch_array($result)) {
$select_info = mysql_query("SELECT * FROM users WHERE id=".$row['owner_id']."");
while($info = mysql_fetch_array($select_info)) {
$usersname = $info['username'];
$user_stam = $info['stamina'];
}
echo '<div style="color: yellow;">'.$count++.'.'.$usersname.' | Bounties: '.$row['bounties'].' | Stamina: '.$user_stam.'</div>';
}
?>
</body>
