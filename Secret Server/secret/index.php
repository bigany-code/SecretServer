<?php

//adat lekeres ha nem form
$requestPayload = json_decode(file_get_contents('php://input'), true);
$secret = $requestPayload[0];
$expireAfterViews = $requestPayload[1];
$expireAfterMinutes = $requestPayload[2];

//Form submit
if (isset($_POST["secret"], $_POST["expireAfterViews"], $_POST["expireAfter"])) {
    $secret = $_POST["secret"];
    $expireAfterViews = $_POST["expireAfterViews"];
    $expireAfterMinutes = $_POST["expireAfter"];
}

$responseData = array(
    $secret,
    $expireAfterViews,
    $expireAfterMinutes
);

//formatting response
$responseFormat = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';
if (strpos($responseFormat, 'application/json') !== false) {
    // JSON response
    $response = json_encode($responseData);
    header('Content-Type: application/json');
} elseif (strpos($responseFormat, 'application/xml') !== false) {
    // XML response
    $xml = new SimpleXMLElement('<response/>');
    array_walk_recursive($responseData, array($xml, 'addChild'));
    $response = $xml->asXML();
    header('Content-Type: application/xml');
} else {
    // JSON def, if not specified or unsupported
    $response = json_encode($responseData);
    header('Content-Type: application/json');
}

//rnd url
$randomUrl = bin2hex(random_bytes(8));


$servername = "localhost";
$username = "uname";
$password = "passwd";
$dbname = "secret";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO secrets (url, secret, expire_after_views, expire_after_minutes) VALUES ('$randomUrl', '$secret', '$expireAfterViews', '$expireAfterMinutes')";
$conn->query($sql);
$conn->close();
$url = "http://localhost/Code2/Secret%20Server/view_secret.php?url=" . $randomUrl;
$data = $url;

// convert 2 format
if (strpos($responseFormat, 'application/json') !== false) {
    $jsonResponse = json_encode($data);
} elseif (strpos($responseFormat, 'application/xml') !== false) {
    $xmlResponse = new SimpleXMLElement('<data/>');
    $xmlResponse->addChild('url', $data);
    $jsonResponse = json_encode($xmlResponse);
} else {
    // JSON def, if not specified or unsupported
    $jsonResponse = json_encode($data);
}


// Get the referring URL
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Check if the referring URL is valid
if (!empty($referer)) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $referer);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonResponse);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
    }

    curl_close($curl);
}
//if success do this:
echo "Generated URL: <a href='$url'>$url</a>\n";
echo "<br>\n";
echo "Secret Message: '$secret'\n";

//Logs to console if submitted by a form
echo "<br>\n";
echo "$url\n\n";
