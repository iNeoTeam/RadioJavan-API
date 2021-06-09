<?php
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api = "https://api.ineo-team.ir"; //don't change it.
$parameters = array(
   'auth' => "rj9143484418", // http-access-token
   'action' => "search", // request method
   'type' => "video", // music/video
   'query' => "Pishro" // search query
);
$output = json_decode(file_get_contents($api."/radiojavan.php?".http_build_query($parameters)));
if($output->status == "successfully"){
    $r = $output->result;
    echo json_encode(['ok' => true, 'status' => "successfully", 'result' => ['count' => $r->count, 'type' => $r->search_type, 'searchResult' => $r->search_result]]);
}else{
    echo json_encode(['ok' => false, 'status' => $output->status]);
}
unlink("error_log");
?>