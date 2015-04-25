<?php session_start() ?>
<?php
$connect = mysql_connect('localhost','database','password');
mysql_select_db('dir') or mysql_error();

if (isset($_SESSION['login'])){
	$session = explode('|',$_SESSION['login']);
	if (isset($session[1])) {
		$logging_in = mysql_query("SELECT * FROM users WHERE email='".$session[0]."' LIMIT 1");	
		if (mysql_num_rows($logging_in) == 1) {
			$stats = mysql_fetch_array ( $logging_in, MYSQLI_ASSOC ); 
			if ($session[1] == md5($stats['email'].$stats['password'])) {
				$LOGGED_IN = true;	
				$id = $stats['id'];
				$ip = $stats['ip'];
				$admin = $stats['admin'];
				$image = $stats['image'];
				$username = $stats['username'];
				$email = $stats['email'];				
				$password = $stats['password'];
				$joined = $stats['joined'];
				$level = $stats['level'];
				$cash = $stats['cash'];
				$health = $stats['health'];
				$max_health = $stats['max_health'];						
				$energy = $stats['energy'];
				$max_energy = $stats['max_energy'];		
				$e_income = $stats['e_income'];
				$stamina = $stats['stamina'];	
				$max_stamina = $stats['max_stamina'];	
				$exp = $stats['exp'];
				$max_exp = $stats['max_exp'];
				$exp_width = $exp / $max_exp * 100;
				$health_width = $health / $max_health * 100;
				$energy_width = $energy / $max_energy * 100;
				$stamina_width = $stamina / $max_stamina * 100;
				$bank = $stats['bank'];
				$income = $stats['income'];
				$upkeep = $stats['upkeep'];				
				$points = $stats['points'];
				$skills = $stats['skill_points'];
				$heal_cost = $stats['heal_cost'];
				$missions = $stats['missions'];
				$attack = $stats['attack'];
				$defense = $stats['defense'];
				$wins = $stats['wins'];	
				$loses = $stats['loses'];	
				$kills = $stats['kills'];	
				$deaths = $stats['deaths'];	
				$boss_kills = $stats['boss_kills'];					
				$draws = $stats['draws'];	
				$bounties = $stats['bounties'];			
				$bounties = $stats['bounties'];																				
				$energy_bonus = $stats['energy_bonus'];																				
				$payment = $stats['payment'];	
				$mob_size = $stats['mob_size'];	
				$hired_guns = $stats['hired_guns'];
				$total_mob = $mob_size + $hired_guns;
				$location = $stats['location'];																			
				$travel_time = $stats['travel'];																			
				$topmob_bonus = $stats['topmob_bonus'];																			
				$topmob_energy = $stats['topmob_energy'];																			
				$daily_bonus = $stats['daily_bonus'];																			
				$daily_energy = $stats['daily_energy'];		
				$last_login = $stats['last_login'];		
				$knuckles = $stats['knuckles'];
				// Achievements
				$ach_missions = $stats['ach_missions'];																	
				$ach_hitman = $stats['ach_hitman'];																	
				$ach_kills = $stats['ach_kills'];																	
				$ach_boss = $stats['ach_boss'];																	
				$ach_mobsize = $stats['ach_mobsize'];																	
				$ach_beta = $stats['ach_beta'];		
				// Other
				$thanksgiving = $stats['thanksgiving'];
				$christmas = $stats['christmas'];
				$patricks = $stats['patricks'];
				$last_active = $stats['last_active'];
			}
		}
	}
}
if (!isset($LOGGED_IN)) {
	$LOGGED_IN = false;	
}
?>
