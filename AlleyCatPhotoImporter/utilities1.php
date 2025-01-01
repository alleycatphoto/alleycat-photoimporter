<?php
ini_set('log_errors', 1);
ini_set('error_log', '../logs/debug.log');

// Directory path to start scanning
$baseDir = realpath('../Import'); // Point to the root import directory

// Function to recursively parse directory
function parseJpgFiles($directory) {
    $result = [];

    // Create a Recursive Directory Iterator
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($iterator as $file) {
        if ($file->isFile() && strtolower($file->getExtension()) === 'jpg') {
            $filePath = $file->getPathname();
            $normalizedPath = str_replace('\\', '/', $filePath); // Normalize backslashes

            // Extract category and location from directory structure
            $relativePath = str_replace(str_replace('\\', '/', realpath('../Import')) . '/', '', $normalizedPath);
            $pathParts = explode('/', $relativePath);

            if (count($pathParts) < 3) {
                error_log('Skipped file with insufficient directory depth: ' . $normalizedPath);
                continue;
            }

            $location = $pathParts[0];
            $category = $pathParts[1];

            // Debugging normalized and relative paths
            error_log('Normalized path: ' . $normalizedPath);
            error_log('Relative path: ' . $relativePath);

            // Get image dimensions using GD library
            list($width, $height) = getimagesize($filePath);

            // Extract non-null EXIF data
            $exifData = @exif_read_data($filePath) ?: [];
            $filteredExif = array_filter($exifData, function ($value) {
                return !is_null($value);
            });

            // Calculate time span for alt text
            $fileTime = filemtime($filePath);
            $startTime = date('h:i A', $fileTime);
            $endTime = date('h:i A', $fileTime + 7200); // Add 2 hours

            // Build result
            $result[] = [
                'asset' => $file->getFilename(),
                'width' => $width,
                'height' => $height,
                'alt' => "Photos © " . date('Y') . " Alley Cat Photography - $location ($category) : " . date('m/d/Y', $fileTime) . " $startTime - $endTime",
                'year' => date('Y', $fileTime),
                'month' => date('m', $fileTime),
                'day' => date('d', $fileTime),
                'type' => 'jpg',
                'category' => $category,
                'photoNumber' => sprintf('%05d', $fileTime % 100000),
                'exif' => $filteredExif,
                'time' => date('H:i:s', $fileTime),
                'location' => $location,
                'path' => $normalizedPath
            ];
        }
    }

    // Debugging output
    if (empty($result)) {
        error_log('No files matched after processing: ' . $directory);
    } else {
        error_log('Parsed Files: ' . json_encode($result, JSON_PRETTY_PRINT));
    }

    return $result;
}

// Start parsing
$parsedFiles = parseJpgFiles($baseDir);

// Debugging empty result
if (empty($parsedFiles)) {
    echo json_encode(['error' => 'No matching files found in the directory.'], JSON_PRETTY_PRINT);
    exit;
}

// Convert result to Shopify-compatible JSON
$shopifyCompatibleJson = array_map(function($file) {
    return [
        'asset' => $file['asset'],
        'width' => $file['width'],
        'height' => $file['height'],
        'alt' => $file['alt'],
        'year' => $file['year'],
        'month' => $file['month'],
        'day' => $file['day'],
        'type' => $file['type'],
        'category' => $file['category'],
        'photoNumber' => $file['photoNumber'],
        'exif' => $file['exif'],
        'time' => $file['time'],
        'location' => $file['location']
    ];
}, $parsedFiles);

// Output JSON
header('Content-Type: application/json');
echo json_encode($shopifyCompatibleJson, JSON_PRETTY_PRINT);
?>
