<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=399346120146835&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="LoginResults" align="center" class="PopUp"></div>
<div align="center"><div id="HomePageNames">Welcome To PsychoWars! <span style="float: right; margin-right: 2px;"><div class="fb-like" data-href="https://www.facebook.com/psychowarsgame" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></span></div></div> 
<!-- News | Side Bar -->
<table width="600" align="center">
  <tr>
	<td class="NewsColumn" valign="top">
	<img src="images/PlayFreeToday.jpg" width="395" height="125" style="margin-bottom: 3px;" />
	<div class="NewsBlock">
	<div class="NewsTitle">PsychoWars News<span class="NewsTime">When</span></div>
	<div class="NewsMessage">Giving You Up-To-Date News!</div>
	</div>
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
	$select_news = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 5");
	while($news = mysql_fetch_array($select_news)) {
	$news_name = $news['name'];
	$news_message = $news['message'];
	$news_time = $news['time'];
	echo 
	'<div class="NewsBlock">
	<div class="NewsTitle">'.$news_name.' <span class="NewsTime">'.time_elapsed_string($news_time).'</span></div>
	<div class="NewsMessage">'.$news_message.'</div>
	</div>';
	}
	?>
	<!-- DPR -->
	<div align="center"><?php include 'images/DawgPoundPsycho.html' ?></div>
	<!-- DPR End -->
	</td>
	<td class="SideBar" valign="top">	
	<!-- Login Forms Start -->
	<div id="LoginBlock">
	<div id="LoginText">Login: </div>
	<form action="javascript:void" method="post">
    <table width="198" align="Center">
	  <tr>
		<td style="max-width: 90px;"><span class="FormText">Email: </span></td>
		<td style="max-width: 100px;"><input type="text" id="email" size="15" /></td>
	  </tr>
	  <tr>
		<td style="max-width: 90px;"><span class="FormText">Password: </span></td>
		<td style="max-width: 100px;"><input type="password" id="password" size="15" /></td>
	  </tr>	  
	  <tr>
		<td colspan="2" align="right">
		<input type="submit" value="Login" class="LoginButton" onClick="Login()" />
		<input type="reset" value="Reset" class="LoginButton" />
		</td>
	  </tr>		  
	</table>
    </form>
	</div>
	<!-- Login Forms End-->
	<!-- Statistics Start -->
		<div id="StatisticTitleTop" align="Center">Game Stats</div>
		<div id="StatisticBlock">
		<div id="StatisticInfo">
		<?php
		$active_time = strtotime('-10 minutes',time());
		$select_accounts = mysql_query("SELECT id FROM users"); 
		$select_active = mysql_query("SELECT * FROM users WHERE last_active > ".$active_time."");
		$select_logins = mysql_query("SELECT * FROM logins_today");
		while($log_num = mysql_fetch_array($select_logins)) {
			$login_today = $log_num['logins'];
		}
		?>
		Accounts Made: <?php echo number_format(mysql_num_rows($select_accounts)); ?><br />
		Users Online: <?php echo number_format(mysql_num_rows($select_active)); ?><br />
		Logins Today: <?php echo number_format($login_today); ?><br />
		</div>
		</div>
		<div id="StatisticTitleBottom" align="Center"></div>	
	<!-- Statistics End -->
	<!-- ScreenShots -->
	<div id="StatisticTitleTop" align="Center">ScreenShots</div>
	<div id="StatisticBlock" align="center">
	<div class="SSBlock"><img src="images/screenshots/Broadcast.jpg" width="190" height="100" onClick="ScreenShot('Broadcast')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Jobs.jpg" width="190" height="100" onClick="ScreenShot('Jobs')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Operations.jpg" width="190" height="100" onClick="ScreenShot('Operations')" /></div>
	<div class="SSBlock"><img src="images/screenshots/AttackPlayers.jpg" width="190" height="100" onClick="ScreenShot('AttackPlayers')" /></div>
	<div class="SSBlock"><img src="images/screenshots/BossList.jpg" width="190" height="100" onClick="ScreenShot('BossList')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Estate.jpg" width="190" height="100" onClick="ScreenShot('Estate')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Hitlist.jpg" width="190" height="100" onClick="ScreenShot('Hitlist')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Bounties.jpg" width="190" height="100" onClick="ScreenShot('Bounties')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Armory.jpg" width="190" height="100" onClick="ScreenShot('Armory')" /></div>
	<div class="SSBlock"><img src="images/screenshots/TopPlayers.jpg" width="190" height="100" onClick="ScreenShot('TopPlayers')" /></div>
	<div class="SSBlock"><img src="images/screenshots/TopMob.jpg" width="190" height="100" onClick="ScreenShot('TopMob')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Families.jpg" width="190" height="100" onClick="ScreenShot('Families')" /></div>
	<div class="SSBlock"><img src="images/screenshots/Travel.jpg" width="190" height="100" onClick="ScreenShot('Travel')" /></div>
	</div>
	<div id="StatisticTitleBottom" align="Center"></div>
	</td>
  </tr>
</table> 
<div id="PopUpSS" align="center"></div>
<div id="MaskSS" onClick="SSClose();" title="Click To Close Popup!"></div>
