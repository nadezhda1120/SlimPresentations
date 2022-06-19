<?php
require_once "config.php";

$tags = $_GET["tags"];
$tags_array = explode (",", $tags);
$newData = "";

foreach ($tags_array as $tag) {
    foreach($result as $row) {
        if (str_contains($row['tags'], $tag)) {
            $newData .= base64_decode($row['data']) . "\n";
        }
    }
}
echo $newData;

