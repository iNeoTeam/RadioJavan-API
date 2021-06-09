<?php
/*
Radio Javan API Example

Powered By iNeoTeam (T.me/iNeoTeam)
Coded By Amir Hossein Yeganeh (T.me/CrossXss)
*/
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api	= "https://api.ineo-team.ir/radiojavan.php"; // don't change it
$auth	= "rj0123456789"; // replace your api http access token; buy from: @RadioJavanComBot
$link	= "https://www.radiojavan.com/mp3s/mp3/Hamid-Sefat-Too-Deli"; // example radio javan music or video link
$get    = file_get_contents($link);
function json($array){
	echo json_encode($array);
	unlink("error_log");
	exit;
}
if(strpos($get, "radiojavan://video/") !== false){
	$type = "video";
	preg_match('#<meta property="al:ios:url" content="radiojavan://video/(.*?)/" />#su', $get, $id);
	$rj = $api."?auth=$auth&action=$type&id=".$id[1];
	$request = json_decode(file_get_contents($rj));
	if($request->status != "successfully."){
		json(['ok' => false, 'status' => $request->status]);
	}
	json(['ok' => true, 'status' => $request->status, 'result' => $request->result]);
}elseif(strpos($get, "mp3id=") !== false){
	$type = "music";
	preg_match('#<button class="button textButton mp3_playlist_add_player" mp3id="(.*?)">#su', $get, $id);
	$rj = $api."?auth=$auth&action=$type&id=".$id[1];
	$request = json_decode(file_get_contents($rj));
	if($request->status != "successfully."){
		json(['ok' => false, 'status' => $request->status]);
	}
	json(['ok' => true, 'status' => $request->status, 'result' => $request->result]);
}else{
	json(['ok' => false, 'status' => "link is false."]);
}
?>
