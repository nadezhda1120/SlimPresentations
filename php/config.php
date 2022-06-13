<?php
$db_host = 'localhost';
$db_user = 'webadmin';
$db_password = 'webadmin';
$db_db = 'webadmin';
global $mysqli;

$mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: ' . $mysqli->connect_errno;
    echo '<br>';
    echo 'Error: ' . $mysqli->connect_error;
    exit();
}

global $result;
$sql = "SELECT id, name, tags, data FROM presentations";
$result = $mysqli->query($sql);
?>