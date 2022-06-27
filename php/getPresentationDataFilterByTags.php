<?php
require_once "config.php";

$tags = $_GET["tags"];
$tags_array = explode (",", $tags);
$trimmed = array_map('trim', $tags_array);
$newData = "";

foreach ($trimmed as $tag) {
    foreach($result as $row) {
        if (str_contains($row['tags'], $tag)) {
            $newData .= base64_decode($row['data']) . "\n";
        }
    }
}
echo $newData;

