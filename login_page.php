<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if(!$id): ?>
<div id="LoginResults" align="center"></div>
<table width="600" align="center">
  <tr>
    <td width="400" valign="top"><img src="images/Login.png" height="135" width="400" /></td>
    <td width="188" valign="top">
    <div id="LoginBlock">
    <div id="LoginText">Login: </div>
    <form action="javascript:void" method="post">
    <span class="FormText">Email: </span><br />
    <input type="text" id="email" />
    <span class="FormText">Password: </span><br />
    <input type="password" id="password" />
    <input type="submit" value="Login" onClick="Login()" />
    </form>
    </div>
    </td>
  </tr>
</table>
<?php else: ?>
<div align="center">
	<div id="LoggedStats">
	<div id="Username"><span id="Welcome">Welcome Back</span> <?php echo $username ?>!</div>
	<div id="Level">[Level: <?php echo number_format($level) ?>]</div>
    <div id="Logout" onClick="window.open('logout','_self');">[Logout]</div>   
</div>
<div id="LoggedPlay" align="center"><a href="play"><img src="images/Play.png" width="150" height="80" /></a></div>
</div>
<?php endif; ?>
