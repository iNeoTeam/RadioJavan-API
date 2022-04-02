<?php
/*
	* Name:
		RadioJavan Full Access API
	* Language:
		PHP
	* Documents:
		https://api.ineo-team.ir/docs.php?apiName=radiojavan
	* Examples:
		https://github.com/iNeoTeam/RadioJavan-API
	* Telegram Bot:
		@RadioJavanComBot
	* Get HTTP TOKEN:
		T.me/RadioJavanComBot?start=dev
	* Coded By:
		Sir.4m1R [Contact: T.me/CrossXss]
	* Powered By:
		iNeoTeam [Contact: T.me/iNeoTeam]
	* Date:
		1400/10/17 | 13:00:00 (Asia/Tehran)
*/
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api = "https://api.ineo-team.ir";		// Don't change it!
define('AUTH', "rj1234567890");			// Replace your RadioJavan api http access key.
function RadioJavan($method, $data = []){
	global $api;
	$data['action'] = $method;
	$cURL = curl_init();
	curl_setopt($cURL, CURLOPT_URL, $api."/RadioJavan-vr.php?".http_build_query($data));
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Authentification: '.AUTH
	));
	$Result = json_decode(curl_exec($cURL), true);
	curl_close($cURL);
	return $Result;
}
// Example Request:
$data = ['name' => "Pishro"];
echo json_encode(RadioJavan("artist", $data));
unlink("error_log");
?>
