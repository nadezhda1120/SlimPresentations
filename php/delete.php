<?php
require_once "config.php";
$id = $_GET["id"];
$sql = "DELETE FROM presentations1 WHERE id='$id'";

if ($mysqli->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(400);
}

$mysqli->close();
?>