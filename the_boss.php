<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id){ die('<div align="center" class="Fail">Error: Refresh</div>'); } ?>
<body>
<div id="Page" align="center">The Boss :: <span id="Points">You Currently Have <?php echo number_format($points) ?> Boss Points</span></div>
<!-- Refills | ETC -->
<center>
<!-- Health -->
<div style="width: 600px;" align="left">
<div id="TBossBlock">
<div id="TBossName">Health: 5 Points</div>
<center><img src="images/Refill-Health.jpg" width="175" height="65" /></center>
<center><input type="submit" value="Refill Health" onClick="Refill('health')" /></center>
</div>
<!-- Energy -->
<div id="TBossBlock">
<div id="TBossName">Energy: 5 Points</div>
<center><img src="images/Refill-Energy.jpg" width="175" height="65" /></center>
<center><input type="submit" value="Refill Energy" onClick="Refill('energy')" /></center>
</div>
<!-- Stamina -->
<div id="TBossBlock">
<div id="TBossName">Stamina: 5 Points</div>
<center><img src="images/Refill-Stamina.jpg" width="175" height="65" /></center>
<center><input type="submit" value="Refill Stamina" onClick="Refill('stamina')" /></center>
</div>
<!-- Hired Guns -->
<div id="TBossBlock">
<div id="TBossName">Hired Gun: 15 Points</div>
<center><img src="images/HiredGun.jpg" width="175" height="65" /></center>
<div id="TBossOwned">You Own: <?php echo number_format($hired_guns) ?></div>
<center><input type="submit" value="Buy Hired Gun" onClick="BuyBossOption(1)" /></center>
</div>
<!-- Brass Knuckles -->
<div id="TBossBlock">
<div id="TBossName">Brass Knuckles: 20 Points</div>
<center><img src="images/BrassKnuckles.jpg" width="175" height="65" /></center>
<div id="TBossOwned">You Own: <?php echo number_format($knuckles) ?></div>
<center><input type="submit" value="Buy Brass Knuckles" onClick="BuyBossOption(2)" /></center>
</div>
<!-- Change Name -->
<div id="TBossBlock" style="height: 133px; vertical-align: top;">
<div id="TBossName">Change Name: 10 Points</div>
<center>
<input type="text" id="NameChange" /><br /><br />
<input type="submit" value="Change Name" onClick="ChangeName()" />
</center>
</div>
<!-- Offers -->
<div id="TBossBlock" style="height: 133px; vertical-align: top;">
<div id="TBossName">Various Offers: </div>
<center>
<select id="VarOff">
	<option value="1">Coming Soon..</option>
</select><br /><br />
<input type="submit" value="Accept Offer" onClick="AccOff()" />
</center>
</div>
<!-- Reset Skills -->
<div id="TBossBlock" style="height: 133px; vertical-align: top;">
<div id="TBossName">Reset Skills: 30 Points</div>
<center><input type="submit" value="Reset Skills" onClick="ResetSkills()" /></center>
</div>
</center>
<!-- Buying Offers -->
<center>
<img src="images/20Percent.jpg" /><br />
<div style="width: 600px;" align="left">
<?php
//$point_offers = mysql_query("SELECT * FROM buying_offers ORDER BY points");
//while($offer = mysql_fetch_array($point_offers)) {
//$offer_name = $offer['package'];
//$offer_points = $offer['points'];
//$offer_energy = $offer['energy'];
//$offer_cost = $offer['cost'];
//$offer_button = $offer['button'];
//echo
//'<div id="OfferBlock">
//<div id="OfferName">'.$offer_name.'</div>
//<div id="OfferInfo">&#8226; Points: '.number_format($offer_points).'</div>
//<div id="OfferInfo">&#8226; Energy: '.number_format($offer_energy).'</div>
//<div id="OfferCost">Cost: $'.$offer_cost.'</div>
//<center>'.$offer_button.'</center>
//</div>';
//}
?>
</div></center>
<center>
<div style="width: 600px;" align="left">
<!-- Buying Offers End -->
<!-- Offer 1 -->
<div id="OfferBlock">
<div id="OfferName">Noob Package</div>
<div id="OfferInfo">&#8226; Points: 30</div>
<div id="OfferInfo">&#8226; Energy: 500</div>
<div id="OfferCost">Cost: $<strike>5</strike> $4</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="DNSM3VDM7BCJG">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
<!-- Offer 2 -->
<div id="OfferBlock">
<div id="OfferName">Starter Package</div>
<div id="OfferInfo">&#8226; Points: 70</div>
<div id="OfferInfo">&#8226; Energy: 1,200</div>
<div id="OfferCost">Cost: $<strike>10</strike> $8</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="7LN77JVR8HHK4">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
<!-- Offer 3 -->
<div id="OfferBlock">
<div id="OfferName">War Package</div>
<div id="OfferInfo">&#8226; Points: 155</div>
<div id="OfferInfo">&#8226; Energy: 3,000</div>
<div id="OfferCost">Cost: $<strike>20</strike> $16</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8JV5RSGS2YBEL">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
<!-- Offer 4 -->
<div id="OfferBlock">
<div id="OfferName">Name Package</div>
<div id="OfferInfo">&#8226; Points: 320</div>
<div id="OfferInfo">&#8226; Energy: 7,500</div>
<div id="OfferCost">Cost: $<strike>50</strike> $40</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KHGZX78EVPWDQ">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
<!-- Offer 5 -->
<div id="OfferBlock">
<div id="OfferName">Psycho Package</div>
<div id="OfferInfo">&#8226; Points: 666</div>
<div id="OfferInfo">&#8226; Energy: 20,000</div>
<div id="OfferCost">Cost: $<strike>100</strike> $80</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="33TYUKF5XPD6U">
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
<!-- Offer 5 -->
<div id="OfferBlock">
<div id="OfferName">Killer Package</div>
<div id="OfferInfo">&#8226; Points: 1,100</div>
<div id="OfferInfo">&#8226; Energy: 50,000</div>
<div id="OfferCost">Cost: $<strike>150</strike> $120</div>
<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_new">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5NYLU7V8Y7YRQ">
<input type="hidden" name="custom" value="<?php echo $id ?>" />
<input type="image" src="http://www.psychowars.net/app/images/BuyNowPaypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</center>
</div>
</body>
