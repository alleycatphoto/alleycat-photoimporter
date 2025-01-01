<?php
header('Content-Type: application/json');

$directory = './photos';
$photos = [];
if ($handle = opendir($directory)) {
    while (false !== ($file = readdir($handle))) {
        if (preg_match('/\.jpg$/i', $file)) {
            $photos[] = ['path' => "$directory/$file"];
        }
    }
    closedir($handle);
}

echo json_encode(['photos' => $photos]);
?>
