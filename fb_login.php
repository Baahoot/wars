<?php session_start() ?>
<?php require 'connect.php' ?>
<link href="app.css" rel="stylesheet" type="text/css" />
<?php
define('FACEBOOK_APP_ID', '###'); // Place your App Id here
define('FACEBOOK_SECRET', '###'); // Place your App Secret Here

// No need to change the function body
function parse_signed_request($signed_request, $secret)
{
list($encoded_sig, $payload) = explode('.', $signed_request, 2);
// decode the data
$sig = base64_url_decode($encoded_sig);
$data = json_decode(base64_url_decode($payload), true);
if (strtoupper($data['algorithm']) !== 'HMAC-SHA256')
{
error_log('Unknown algorithm. Expected HMAC-SHA256');
return null;
}

// check sig
$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
if ($sig !== $expected_sig)
{
error_log('Bad Signed JSON signature!');
return null;
}
return $data;
}
function base64_url_decode($input)
{
return base64_decode(strtr($input, '-_', '+/'));
}
if ($_REQUEST)
{
$response = parse_signed_request($_REQUEST['signed_request'],
FACEBOOK_SECRET);

$r_email = $response["registration"]["email"];
$r_password = $response["registration"]["password"];
$time = time();
$new_ip = $_SERVER['REMOTE_ADDR'];
$reg_payment = time() + 3600;
$new_ip = $_SERVER['REMOTE_ADDR'];
// Check if already registered
$select_email = mysql_query("SELECT * FROM users WHERE email='".$r_email."' LIMIT 1");
if(mysql_num_rows($select_email) > 0) {
	die('<script>window.location = "http://www.psychowars.net/app_develop/?register=FailedActive";</script>');
}
// Inserting into users table
$insert = mysql_query("INSERT INTO users 
							(email, password, payment, ip) 
							VALUES 
							('$r_email', '$r_password', '$reg_payment','$new_ip')");
if($insert){
// User successfully stored
	echo '<script>window.location = "http://www.psychowars.net/app_develop/?register=Success";</script>';	
}
else {
// Error in storing
	die('<script>window.location = "http://www.psychowars.net/app_develop/?egister=Failed";</script>');
	}
}
else {
die('<script>window.location = "http://www.psychowars.net/app_develop/?register=Failed";</script>');
}
?>
