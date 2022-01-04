<?php
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api = "https://api.ineo-team.ir"; //don't change it.
$parameters = array(
   'auth' => "rj2995170299", // http-access-token
   'action' => "idfinder", // request method
   'link' => "https://www.radiojavan.com/videos/video/hamid-sefat-bakhshesh-(ft-amirabbas-golab)" // radiojavan music/video/podcast link
);
$output = json_decode(file_get_contents($api."/radiojavan.php?".http_build_query($parameters)));
if($output->status == "successfully"){
    echo json_encode(['ok' => true, 'status' => $output->status, 'result' => [
        'action' => $parameters['action'],
        'id' => $output->result->id,
        'type' => $output->result->type
    ]]);
}else{
    echo json_encode(['ok' => false, 'status' => $output->status]);
}
unlink("error_log");
?>
