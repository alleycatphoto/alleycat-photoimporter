<?php
require_once 'utilities.php';

// Parse files in the directory
$parsedFiles = parseJpgFiles('../Import');

// Output JSON response
header('Content-Type: application/json');
echo json_encode($parsedFiles, JSON_PRETTY_PRINT);
?>
