<?php session_start() ?>
<?php require 'connect.php' ?>
<table width="600" align="center">
  <tr>
    <td colspan="2">
    <div id="Username" onClick="ViewUser(<?php echo $id ?>)"><?php echo $username ?></div> 
    <div id="Level">[Level: <span id="LevelText"></span>]</div>
    <div id="ExpBar" style="cursor:pointer;" title="Hover To See EXP Needed">
    <div id="ExpWidth" style="width: <?php echo number_format($exp_width) ?>%; max-width: 99%; background: linear-gradient(to bottom, #666666 0%, #111111 100%) repeat scroll 0% 0% #666666; border-radius: 5px; border-radius: 5px; -moz-border-radius: 5px; padding: 1px;">
    <div style="width: 125px;">
    <span style="margin-left: 2px;" id="ExpPercent">Exp: <span id="ExpText"></span></span>
	<span id="EXPTxt">EXP Needed: </div>
    </div>
    </div>
    </div>
	<span id="LogoutOptions">
    <div id="Logout" onClick="window.open('logout','_self');">[Logout]</div>
	</span>
	<?php
	if($admin == '1') {
		echo '<div id="Logout" onClick="FindTab(\'admin_panel\')">[Admin Panel]</div>';
	}
	else {
	}
	?>
    </td>
  </tr>
  <tr>
    <td width="60" rowspan="2" valign="top"><div id="Image"><img src="<?php echo $image ?>" width="60" height="60" /></div></td>
    <td width="456">
    <div id="StatText">Cash: <span id="Cash"></span></div>
    <div id="StatText">Income: <span id="Income"></span></div>
	<div id="StatText">Energy Income: <span id="EIncome" style="color: green;"></span></div>
    </td>
  </tr>
  <tr>
    <td>
    <div id="Health">
    <div id="HealthWidth" style="width: <?php echo number_format($health_width) ?>%; max-width: 99%; background: linear-gradient(to bottom, #0f0 0%, #111111 100%) repeat scroll 0% 0% #0f0; border-radius: 5px; border-radius: 5px; -moz-border-radius: 5px; padding: 1px;">
    <div style="width: 125px;">
    <span style="margin-left: 2px;">Health: <span id="HealthText"></span></span>
    </div>
    </div>
    </div>    
    <div id="Energy">
    <div id="EnergyWidth" style="width: <?php echo number_format($energy_width) ?>%; max-width: 99%; background: linear-gradient(to bottom, #00f 0%, #111111 100%) repeat scroll 0% 0% #00f; border-radius: 5px; border-radius: 5px; -moz-border-radius: 5px; padding: 1px;">
    <div style="width: 125px;">
    <span style="margin-left: 2px;">Energy: <span id="EnergyText"></span></span>
    </div>
    </div>
    </div>    
    <div id="Stamina">
    <div id="StaminaWidth" style="width:<?php echo number_format($stamina_width) ?>%; max-width: 99%; background: linear-gradient(to bottom, #900000 0%, #111111 100%) repeat scroll 0% 0% #900000; border-radius: 5px; border-radius: 5px; -moz-border-radius: 5px; padding: 1px;">
    <div style="width: 125px;">
    <span style="margin-left: 2px;">Stamina: <span id="StaminaText"></span></span>
    </div>
    </div>
    </div>
    <div style="display: inline-block;" align="center"><input id="RefreshButton" type="submit" onClick="Refresh('home')" value="Refresh" /></div>
    </td>
  </tr>
</table>
<!-- Tabs Start-->
<table align="center" width="600">
  <tr>
  	<td align="left">
    <div id="Tab" onClick="FindTab('home')">Home</div>
    <div id="Tab" onClick="FindTab('missions')">Jobs</div>
    <div id="Tab" onClick="FindTab('fight')">Fight</div>
    <div id="Tab" onClick="FindTab('estate')">Estate</div>
    <div id="Tab" onClick="FindTab('the_boss')">The Boss</div>
    <div id="Tab" onClick="FindTab('hitlist')">Hitlist</div>
    <div id="Tab" onClick="QuickHeal()">Hospital</div>
    <div id="Tab" onClick="FindTab('armory')">Armory</div>
    <div id="Tab" onClick="FindTab('my_mob')">My Mob</div>
    <div id="Tab" onClick="FindTab('my_mobster')">My Mobster</div>
    <div id="Tab" onClick="FindTab('top_players')">Top Players</div>
    </td>
  </tr>
</table>
<table align="center" width="600" style="margin-bottom: 3px;">
  <tr>
  	<td align="left">
    <div id="SmallTabs" onClick="FindTab('vault')">The Vault</div>	
    <div id="SmallTabs" onClick="PopUp1('bank')" style="Color: #00FF00;">Bank</div>	
    <div id="SmallTabs" onClick="PopUp1('skill_points')">Skill Points</div>
    <div id="SmallTabs" onClick="PopUp('location')">Travel</div>	
    <div id="SmallTabs" onClick="PopUp1('fight_log')">Fight Log</div>
    <div id="SmallTabs" onClick="FindTab('addtrain')">Add Train</div>
    <div id="SmallTabs" onClick="PopUp('award_page')">Apply Award Code</div>
    <div id="SmallTabs" onClick="PopUp1('tos')">TOS</div>
    </td>
  </tr>
</table>
<!-- Tabs End -->
<?php 
if ($admin == '1') {
$javascript = 
'<script type="text/javascript">
function AdminHitlist(Number) {
	$(\'.PopUp\').fadeIn(300);
	$(\'.PopUp\').html(\'<div id="Loading" align="center">..Loading..</div>\');
	$(\'.PopUp\').load(\'admin_hitlist.php?number=\'+Number);
	$(\'#Mask\').fadeIn(300);	
}
</script>';	
}
else {
$javascript = '';
}
echo $panel.$javascript;
?>
