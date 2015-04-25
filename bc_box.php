<!-- BC -->
<div id="BCBox">
<div id="Page" align="center">Broadcast: Click Submit Or Hit Enter!</div>
<div align="center">
<form action="javascript:void" method="post" id="BCForm">
<textarea id="bc_message" class="BC" onkeydown="if (event.keyCode == 13) { Broadcast(); return false; }"></textarea>
<div align="left" style="margin-left: 5px;"> 
<input type="submit" value="Post" onClick="Broadcast()" />
<input type="reset" />
</div>
</form>
</div>
</div>
<?php include 'broadcasts.php' ?>
