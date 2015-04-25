<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<div align="center "id="SubPage">Skill Points</div>
<div align="center" id="AttSkills">
You Currently Have <span id="Skills" style="color: #FFFFFF;"><?php echo number_format($skills) ?></span> Skill Points
</div>
<div id="AttResults" align="center"></div>
<table width="600" align="center">
  <tr>
    <td width="135">
    <div id="AttName">Attack: <span id="Att_attack"><?php echo number_format($attack) ?></span></div>
    </td>
    <td width="290"><div id="AttDesc">Increase  To Deal More Damage In Fights!</div></td>
    <td width="88" align="center"><div id="AttCost">1 Skill Point</div></td>
    <td width="67" align="center"><input type="submit" value="Increase" onClick="Increase('attack')" /></td>
  </tr>
  <tr>
    <td width="135">
    <div id="AttName">Defense: <span id="Att_defense"><?php echo number_format($defense) ?></span></div>
    </td>
    <td width="290"><div id="AttDesc">Increase  To Increase Damage Dealt In Fights!</div></td>
    <td width="88" align="center"><div id="AttCost">1 Skill Point</div></td>
    <td width="67" align="center"><input type="submit" value="Increase" onClick="Increase('defense')" /></td>
  </tr>
  <tr>
    <td width="135">
    <div id="AttName">Max Health: <span id="Att_max_health"><?php echo number_format($max_health) ?></span></div>
    </td>
    <td width="290"><div id="AttDesc">Increase  To Stay In Fights Longer!</div></td>
    <td width="88" align="center"><div id="AttCost">1 Skill Point</div></td>
    <td width="67" align="center"><input type="submit" value="Increase" onClick="Increase('max_health')" /></td>
  </tr>
  <tr>
    <td width="135">
    <div id="AttName">Max Energy: <span id="Att_max_energy"><?php echo number_format($max_energy) ?></span></div>
    </td>
    <td width="290"><div id="AttDesc">Increase To Complete More Missions!</div></td>
    <td width="88" align="center"><div id="AttCost">1 Skill Point</div></td>
    <td width="67" align="center"><input type="submit" value="Increase" onClick="Increase('max_energy')" /></td>
  </tr>
  <tr>
    <td width="135">
    <div id="AttName">Max Stamina: <span id="Att_max_stamina"><?php echo number_format($max_stamina) ?></span></div>
    </td>
    <td width="290"><div id="AttDesc">Increase To Attack, Hitlist, And Punch Users</div></td>
    <td width="88" align="center"><div id="AttCost">2 Skill Points</div></td>
    <td width="67" align="center"><input type="submit" value="Increase" onClick="Increase('max_stamina')" /></td>
  </tr>        
</table>

