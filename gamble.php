<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center"><img src="images/The-Casino.png" /></div>
<table width="600" align="center" background="images/SlotMachine.png" height="250">
  <tr>
    <td>
    <br />
    <div align="center" id="SlotResults">
	<img src="images/SlotUnknown.png" /> 
	<img src="images/SlotUnknown.png" /> 
	<img src="images/SlotUnknown.png" /> 
	</div>
    </td>
  </tr>
  <tr>
    <td>
    <div align="center" id="PlaceBet">
    Place Bet: 
	<input type="submit" class="BetButton" value="$1,000" onClick="SlotMachine(1000)" />
	<input type="submit" class="BetButton" value="$2,500" onClick="SlotMachine(2500)" />
	<input type="submit" class="BetButton" value="$5,000" onClick="SlotMachine(5000)" />
   	<input type="submit" class="BetButton" value="$10,000" onClick="SlotMachine(10000)" /> 
   	<input type="submit" class="BetButton" value="$25,000" onClick="SlotMachine(25000)" /> 
    <span id="YouBet"></span>
	</div>
    </td>
  </tr>
</table>
