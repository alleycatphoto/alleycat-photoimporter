<?php
require_once 'utilities.php';

$data = json_decode(file_get_contents('php://input'), true);

// Process each file in the provided data
$outputDir = '../processed';
foreach ($data as $file) {
    processImage($file, $outputDir);
}

// Append processed data to JSON log
appendToJsonFile('../logs/photos.json', $data);

echo json_encode(['success' => true, 'processed' => count($data)]);
?>
