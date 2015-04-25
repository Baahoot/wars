<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<title>PsychoWars | Register</title>
<body> 
<div align="center"><?php include 'images/NewBanner.html' ?></div>
<div align="center"><div id="HomePageNames">Register</div></div>
<div id="RegisterResults" align="center"></div>
<form action="javascript: void" method="post">
<table width="600" align="center">
  <tr>
    <td width="388" valign="top"><img src="images/Register.png" height="135" width="400" /></td>
    <td width="200" valign="top">
    <div id="LoginBlock">
    <div id="LoginText">Register: </div>
    <span class="FormText">Email: </span><br />
    <input type="text" id="reg_email" placeholder="Email" /><br />   
    <span class="FormText">Password: </span><br />
    <input type="password" id="reg_password" placeholder="Password" /><br />
    <span class="FormText">Confirm Pass: </span><br />
    <input type="password" id="reg_conf_pass" placeholder="Confirm Password" />
    <span class="FormText">Username: </span><br />
    <input type="text" id="reg_username" placeholder="Username" />	<br />
    <input type="Submit" value="Register" onClick="Register()" />
    <input type="reset" />
    </div>
    </td>
  </tr>
  </table>
</form>
<div id="Mask" onClick="ClosePop();" title="Click To Close Popup!"></div>
</body>
