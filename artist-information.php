<?php
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api = "https://api.ineo-team.ir"; //don't change it.
$parameters = array(
   'auth' => "rj2995170299", // http-access-token
   'action' => "artist", // request method
   'name' => "pishro" // radiojavan music/video link
);
$output = json_decode(file_get_contents($api."/radiojavan.php?".http_build_query($parameters)));
if($output->status == "successfully"){
    $r = $output->result;
    echo json_encode(['ok' => true, 'status' => "successfully", 'result' => [
        'name' => $r->artist_name,
        'followers' => $r->followers_count,
        'plays' => $r->plays_count,
        'media_count' => ['music' => $r->all_posted_media_count->music, 'video' => $r->all_posted_media_count->video],
        'profile_in_rj' => $r->profile,
        'banner' => $r->background_image
    ]]);
}else{
    echo json_encode(['ok' => false, 'status' => $output->status]);
}
unlink("error_log");
?>