<?php
require_once "config.php";

$post = json_decode(file_get_contents("php://input"), true);

$name =  $post["name"];

$tag = $post["tag"];
$data = $post["data"];
$sql = "INSERT INTO `presentations` (`name`, `tags`, `data`) VALUES ('".$name."', '".$tag."', '".$data."')";

if ($mysqli->query($sql) === TRUE) {
    http_response_code(200);
} else {
    echo $mysqli->error;
    http_response_code(400);
}

$mysqli->close();

?>