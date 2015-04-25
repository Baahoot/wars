<?php session_start() ?>
<?php require 'connect.php' ?>
<body>
<center>
<div id="BankMessage"></div>
<div id="Page">Bank: $<?php echo number_format($bank) ?></div>
<span class="FormText">Cash: $</span>
<input type="text" value="<?php echo (int)$cash ?>" id="money" />
<input type="submit" value="Deposit" onClick="Bank('deposit')" />
<input type="submit" value="Withdrawal" onClick="Bank('withdrawal')" />
