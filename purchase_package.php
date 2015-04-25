<?php session_start() ?>
<?php require 'connect.php' ?>
<?php
// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 0);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 0);
define("LOG_FILE", "./ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
$keyval = explode ('=', $keyval);
if (count($keyval) == 2)
$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
$value = urlencode(stripslashes($value));
} else {
$value = urlencode($value);
}
$req .= "&$key=$value";
}
// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data
if(USE_SANDBOX == true) {
$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "./cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
{
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
}
curl_close($ch);
exit;
} else {
// Log the entire HTTP response if debug is switched on.
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
}
curl_close($ch);
}
// Inspect IPN validation result and act accordingly
// Split response headers and payload, a better way for strcmp
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp ($res, "VERIFIED") == 0) {
// check whether the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your PayPal email
// check that payment_amount/payment_currency are correct
// process payment and mark item as paid.
// assign posted variables to local variables
$payment_status = $_POST['payment_status'];
$txn_id = $_POST['txn_id'];
$payment_amount = $_POST['mc_gross'];
$receiver_email = $_POST['receiver_email'];
$users_id = $_POST['custom'];
if (($_POST['payment_status'] == 'Completed') AND ($receiver_email == 'bad.karma12323@gmail.com')) {
	
	// Checking Prices
		$percent_off = '20';
		if($percent_off == '20') {
		if($payment_amount == '4.00') {
            $points_amount = '30';
            $points_energy = '500'; 
		}
        if($payment_amount == '8.00') {
            $points_amount = '70';
            $points_energy = '1200'; 
		}

        if($payment_amount == '16.00') {
            $points_amount = '155';
            $points_energy = '3000'; 
        } 

        if($payment_amount == '40.00') {
            $points_amount = '320';
            $points_energy = '7500'; 
        }             

        if($payment_amount == '80.00') {
            $points_amount = '666';
            $points_energy = '20000'; 
        }     
        if($payment_amount == '120.00') {
            $points_amount = '1100';
            $points_energy = '50000'; 
			} 		
		}
		// Normal prices
		else {
		if($payment_amount == '5.00') {
            $points_amount = '30';
            $points_energy = '500'; 
		}
        if($payment_amount == '10.00') {
            $points_amount = '70';
            $points_energy = '1200'; 
		}

        if($payment_amount == '20.00') {
            $points_amount = '155';
            $points_energy = '3000'; 
        } 

        if($payment_amount == '50.00') {
            $points_amount = '320';
            $points_energy = '7500'; 
        }             

        if($payment_amount == '100.00') {
            $points_amount = '666';
            $points_energy = '20000'; 
        }     
        if($payment_amount == '150.00') {
            $points_amount = '1100';
            $points_energy = '50000'; 
			} 		
		}	
		
		//format $points_name
        $points_name=sprintf("%s Points And %s Energy",number_format($points_amount),number_format($points_energy));

        // Update Database
        $update_user = mysql_query("UPDATE users SET points=(points+".($points_amount)."),energy=(energy+".($points_energy).") WHERE id=".$users_id."");
        $add_trans = mysql_query("INSERT INTO transactions (user_id,txn_id,item_name,payment_status,cost,time) VALUES ('$users_id','$txn_id','$points_name','$payment_status','$payment_amount','".time()."')"); 
		$test_update = ("UPDATE users SET points=(points+".$points_amount."),energy=(energy+".$points_energy.") WHERE id=".$users_id."");
        $test_insert = ("INSERT INTO transactions (user_id,txn_id,item_name,payment_status,cost,time) VALUES ('$users_id','$txn_id','$points_name','$payment_status','$payment_amount','".time()."')");  		
			
		$to      = 'bad.karma12323@gmail.com';
		$subject = 'PsychoWars Point Purchase';
		$message = '
		 
		Thank you for your purchase
		 
		-------------------------
		USer ID :: '.$users_id.'
		Item :: '.$points_name.'
		Cost :: $'.$payment_amount.'
		-------------------------
		Testing Variables
		Update User :: '.$test_update.'
		Insert Transaction :: '.$test_insert.'
		-------------------------';
		mail($to, $subject, $message);
		
// Logging 
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
}
	} // End of checking the status and email 
} else if (strcmp ($res, "INVALID") == 0) {
// log for manual investigation
// Add business logic here which deals with invalid IPN messages
if(DEBUG == true) {
error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
}
}
?>
