<?php
require_once "config.php";
$request = json_decode(file_get_contents("php://input"));

$sql = "UPDATE presentations1 SET data='$request->data' WHERE id='$request->id'";

if ($mysqli->query($sql) === TRUE) {
    http_response_code(200);
} else {
    echo $mysqli->error;
    http_response_code(400);
}

$mysqli->close();
?>