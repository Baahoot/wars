<?php session_start() ?>
<?php require 'connect.php' ?>
<form action="javascript:void" method="POST">
<span class="FormText">Award Code: </span>
<input type="text" id="AwardCode" />
<input type="submit" onClick="ApplyCode()" value="Apply" maxlength="5" />
</form>
