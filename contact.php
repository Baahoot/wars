<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<title>PsychoWars | Contact Us</title>
<body> 
<div align="center"><?php include 'images/NewBanner.html' ?></div>
<div align="center"><div id="HomePageNames">Contact Us: <i>Coming Soon</i></div></div>
<form action="javascript:void" method="post">
<table width="400" align="center" id="ContactBlock">
  <tr>
	<td valign="top" style="min-width: 100px; max-width: 100px;" class="FormText">Email: </td>
	<td valign="top" style="min-width: 300px; max-width: 300px;"><input type="email" id="ContactEmail" class="SmallContactForms" /></td>
  </tr>
  <tr>
	<td valign="top" style="min-width: 100px; max-width: 100px;" class="FormText">Subject: </td>
	<td valign="top" style="min-width: 300px; max-width: 300px;"><input type="text" id="ContactSubject" class="SmallContactForms" /></td>
  </tr>
   <tr>
	<td valign="top" style="min-width: 100px; max-width: 100px;" class="FormText">Message: </td>
	<td valign="top" style="min-width: 300px; max-width: 300px;"><textarea id="ContactForm"></textarea></td>
  </tr> 
   <tr>
	<td valign="top" style="min-width: 100px; max-width: 100px;" class="FormText"></td>
	<td valign="top" style="min-width: 300px; max-width: 300px;">
	<input type="submit" value="Send" onClick="SendEmail()" /> <input type="Reset" value="Reset" />
	</td>
  </tr>   
</table>
</form>
<div id="Mask" onClick="ClosePop();" title="Click To Close Popup!"></div>
</body>
