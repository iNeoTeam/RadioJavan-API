<?php
error_reporting(0);
header("content-type: application/json; charset= UTF-8");
$api = "https://api.ineo-team.ir"; //don't change it.
$parameters = array(
   'auth' => "rj2995170299", // http-access-token
   'action' => "idfinder", // request method
   'link' => "https://www.radiojavan.com/mp3s/mp3/Hamid-Sefat-Too-Deli" // radiojavan music/video/podcast link
);
$output = json_decode(file_get_contents($api."/radiojavan.php?".http_build_query($parameters)));
if($output->status == "successfully"){
    $id = $output->result->id;
    $type = $output->result->type;
    if(!in_array($type, ['music', 'video', 'podcast'])){
        echo json_encode(['ok' => false, 'status' => "unknown type"]);
        exit();
    }
    $param = array(
        'auth' => "rj2995170299",
        'action' => $type, //music or video or podcast
        'id' => $id
    );
    $out = json_decode(file_get_contents($api."/radiojavan.php?".http_build_query($param)));
    if($out->status != "successfully."){
        echo json_encode(['ok' => false, 'status' => $out->status]);
        exit();
    }
    echo json_encode(['ok' => true, 'status' => "successfully", 'result' => $out->result]);
}else{
    echo json_encode(['ok' => false, 'status' => $output->status]);
}
unlink("error_log");
?>
