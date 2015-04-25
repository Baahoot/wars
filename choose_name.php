<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/png" href="images/favicon.ico">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="app.js"></script>
<script type="text/javascript">
function ChooseName() {
	var name = $('#choose_name').val();
	$('.PopUp').fadeIn(300);
	$('#Mask').fadeIn(300);
	$('.PopUp').html('<div id="Loading" align="center">..Loading..</div>');
	var dataString = 'name='+name;
			$.ajax({
                type: "POST",
                url: "pick_name.php?"+dataString,
                data: dataString,
                cache: false,
                success: function (Message) {
					$('.PopUp').html(Message);
                }
            });
    return false;		
}
</script>
<title>Choose Name</title>
<body>
<div align="center">
<form action="javascript:void" method="post">
<input type="text" id="choose_name" placeholder="Choose Name:" />
<input type="submit" value="Choose Name" onClick="ChooseName();" />
</form>
</div>
<div id="Mask" onClick="ClosePop();" title="Click To Close Popup!"></div>
<div class="PopUp" align="center"></div>
</body>
