<?php // phpcs:ignoreFile

// Define source and destination paths
$source      = dirname( __DIR__ ) . '/resources';
$destination = dirname( __DIR__, 4 ) . '/assets/awesome9';

// Function to recursively copy files and directories
function recurseCopy($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                recurseCopy($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

recurseCopy($source, $destination);

echo "Folder copied successfully!\n";
