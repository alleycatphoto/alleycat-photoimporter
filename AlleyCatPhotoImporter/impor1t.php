<?php
include 'utilities.php';

header('Content-Type: application/json');

// Simulate photo import
$data = json_decode(file_get_contents('php://input'), true);
$photos = $data['photos'] ?? [];
$results = [];

foreach ($photos as $photo) {
    $path = $photo['path'];
    $resized = resizeImage($path, 1920, 2560);
    $rotated = imagerotate($resized, 90, 0);
    $results[] = ['path' => $path, 'status' => 'processed'];
}

echo json_encode($results);
?>
