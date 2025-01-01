<?php
function parseJpgFiles($directory) {
    $result = [];
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($iterator as $file) {
        if ($file->isFile() && strtolower($file->getExtension()) === 'jpg') {
            $filePath = $file->getPathname();
            $normalizedPath = str_replace('\\', '/', $filePath);
            $pathParts = explode('/', str_replace(realpath($directory) . '/', '', $normalizedPath));
            $location = $pathParts[0] ?? 'Unknown Location';
            $category = $pathParts[1] ?? 'Uncategorized';

            // Retrieve EXIF data
            $exif = @exif_read_data($filePath);
            $dimensions = getimagesize($filePath);

            $fileTime = time();
            $startTime = date('h:i A', $fileTime);
            $endTime = date('h:i A', $fileTime + 7200); // 2 hours span

            $result[] = [
                'asset' => $file->getFilename(),
                'category' => $category,
                'location' => $location,
                'time' => "$startTime - $endTime",
                'path' => $normalizedPath,
                'width' => $dimensions[0] ?? null,
                'height' => $dimensions[1] ?? null,
                'exif' => array_filter($exif ?? [], fn($value) => !is_null($value)),
            ];
        }
    }
    return $result;
}

function appendToJsonFile($filePath, $data) {
    $file = fopen($filePath, 'c+');
    flock($file, LOCK_EX);
    $existingData = json_decode(file_get_contents($filePath), true) ?? [];
    $mergedData = array_merge($existingData, $data);
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, json_encode($mergedData, JSON_PRETTY_PRINT));
    fflush($file);
    flock($file, LOCK_UN);
    fclose($file);
}

function processImage($file, $outputDir) {
    $image = imagecreatefromjpeg($file['path']);
    $exif = @exif_read_data($file['path']);
    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 8: $image = imagerotate($image, 90, 0); break;
            case 3: $image = imagerotate($image, 180, 0); break;
            case 6: $image = imagerotate($image, -90, 0); break;
        }
    }

    // Create directories if they don't exist
    if (!is_dir("$outputDir/raw")) mkdir("$outputDir/raw", 0777, true);
    if (!is_dir("$outputDir/numbered")) mkdir("$outputDir/numbered", 0777, true);

    $scaledPath = "$outputDir/raw/{$file['asset']}";
    $numberedPath = "$outputDir/numbered/{$file['asset']}";

    // Save full-sized image
    imagejpeg($image, $scaledPath, 100);

    // Create and save scaled image
    $scaledImage = imagescale($image, 900, 600);
    imagejpeg($scaledImage, $numberedPath, 90);

    // Clean up
    imagedestroy($image);
    imagedestroy($scaledImage);
}
?>
