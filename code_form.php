<?php session_start() ?>
<?php require 'connect.php' ?>
<?php if($admin < 1) { die('<span class="Fail">Error: You Don\'t Have Permission To Be Here!</span>'); } ?>
<title>Generate Codes</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
function Generate() {
	var item = $('#Item').val();
	var amount = $('#Amount').val();
	$('#Results').html('<div id="Loading">..Loading..</div>');
	$('#Results').load('generate_code.php?item='+item+'&amount='+amount);
	$('#Results').show();
	$('#Codes').html('<div id="Loading">..Loading..</div>');
	$('#Codes').load('awards_codes.php');
	$('#Codes').show('awards_codes.php');
}
</script>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<div align="Center">
<div style="width: 250px; background-color: #333333; border-radius: 6px; padding: 10px; border: 1px solid #FFFFFF;" align="left">
<div id="Results" align="center"></div>
<form action="javascript:void" method="POST">
<span class="FormText">Item :: </span>
<select id="Item">
  <option value="1">Cash</option>
  <option value="2">Skill Points</option>
  <option value="3">Boss Points</option>
  <option value="4">EXP</option>
  <option value="5">Health</option>
  <option value="6">Energy</option>
  <option value="7">Stamina</option>
  <option value="8">Knuckles</option>  
</select><br />
<span class="FormText">Amount :: </span><input type="text" id="Amount" />
<div style="padding-top: 10px;"><input type="submit" value="Generate" onClick="Generate()" /> | <input type="reset" value="Reset" /></div>
</form>
</div>
</div>
<!-- Codes -->
<div align="Center" id="Codes">
<?php include 'awards_codes.php' ?>
</div>
