<?php session_start() ?>
<?php require 'connect.php' ?>
<div align="center "id="Page">Search For A User: </div>
<center>
<div class="SuccessTMC">
<form action="javascript:void" method="POST" />
<span class="FormText">Username: </span>
<input type="text" maxlength="25" id="users_name" />
<input type="submit" value="Search" onClick="SearchUser()" />
</form>
</div>
</center>
<div id="SearchResults"></div>
