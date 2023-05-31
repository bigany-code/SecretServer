<?php
$url = $_GET['url'];

$servername = "localhost";
$username = "uanme";
$password = "passwd";
$dbname = "secret";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM secrets WHERE url = '$url'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // if successful display
    $row = $result->fetch_assoc();
    echo "Secret Message: " . $row['secret'];

    // Update the view count
    $views = $row['views'] + 1;
    $sql = "UPDATE secrets SET views = $views WHERE url = '$url'";
    $conn->query($sql);

    // check db if viewCount is max or if time has expired
    if ($views >= $row['expire_after_views'] || time() >= strtotime($row['created_at']) + ($row['expire_after_minutes'] * 60)) {
        // Delete the secret from the database
        $sql = "DELETE FROM secrets WHERE url = '$url'";
        $conn->query($sql);
        echo "<br>This URL has expired and is no longer valid.";
    }
} else {
    // if doesnt exist(expired,max views,wrong url)
    echo "Invalid URL.";
}

// Close the connection
$conn->close();
?>
