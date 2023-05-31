<?php


$url = "http://localhost/Code2/Secret%20Server/secret/";
$data= array(
    $secret = "aaaaaaa",
    $expireAfterViews = 10,
    $expireAfter = 1
);

$jsonResponse = json_encode($data);
$serverURL = $url;
$curl = curl_init();

//curl options
curl_setopt($curl, CURLOPT_URL, $serverURL);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonResponse);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//curl request kuldes
$response = curl_exec($curl);

// Check 4 success
if ($response === false) {
    $error = curl_error($curl);
} else {
    //do what
    echo $response;
}

curl_close($curl);

?>
