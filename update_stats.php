<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
$count = 1;
$result = mysql_query("SELECT id,health,max_health,energy,max_energy,stamina,max_stamina FROM users")
or die(mysql_error());
while($row = mysql_fetch_array( $result )) {
if ($row['health'] < $row['max_health']) {
	$update_health = ("UPDATE users SET health=(health + 2) WHERE id='".$row['id']."'");
	$res = mysql_query($update_health);	
	$update_heal = 'Updated Health: ' . ($row['health'] + 1) . '';	
}
else {
	$update_heal = 'Health Is Full' . '';	
}
if ($row['energy'] < $row['max_energy']) {
	$update_energy = ("UPDATE users SET energy=(energy + 1) WHERE id='".$row['id']."'");
	$res = mysql_query($update_energy);	
	$update_nrg = 'Updated Energy: ' . ($row['energy'] + 1) . '';	
}
else {
	$update_nrg = 'Energy Is Full' . '';
}
if ($row['stamina'] < $row['max_stamina']) {
	$update_stamina = ("UPDATE users SET stamina=(stamina + 1) WHERE id='".$row['id']."'");
	$res = mysql_query($update_stamina);
	$update_stam =  'Updated Stamina: ' . ($row['stamina'] + 1) . '';	
}
else {
	$update_stam = 'Stamina Is Full' . '';	
}
echo '<div>'.$count++.' - '.$row['username'].' | '.$update_heal.' | '.$update_nrg.' | '.$update_stam.'</div>';
}
?> 
