<?php // phpcs:ignoreFile

// Define source and destination paths
$source = dirname( __DIR__ ) . '/assets/awesome9';
error_log($source);

// Function to recursively delete a directory
function deleteDirectory($dir) {
    if (!is_dir($dir)) return;

    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;

        $filePath = $dir . '/' . $file;
        if (is_dir($filePath)) {
            deleteDirectory($filePath);
        } else {
            unlink($filePath); // Delete file
        }
    }
    rmdir($dir); // Remove empty directory
}

// Check if the target directory exists before attempting to delete
if (is_dir($source)) {
    deleteDirectory($source);
    echo "Folder removed successfully: {$source}\n";
} else {
    echo "Folder does not exist: {$source}\n";
}
