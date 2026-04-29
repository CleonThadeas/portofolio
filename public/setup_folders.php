<?php
$base = __DIR__ . '/storage';

// 1. Force delete the broken symlink or file if it exists
if (is_link($base) || (file_exists($base) && !is_dir($base))) {
    @unlink($base);
}

// 2. Create the main storage folder
if (!file_exists($base)) {
    @mkdir($base, 0775, true);
}

// 3. Create all required subfolders
$folders = ['certificates', 'profiles', 'projects', 'activities'];
$created = [];

foreach ($folders as $folder) {
    $path = $base . '/' . $folder;
    if (!file_exists($path)) {
        if (@mkdir($path, 0775, true)) {
            $created[] = $folder . " (Created)";
        } else {
            $created[] = $folder . " (Failed to create)";
        }
    } else {
        $created[] = $folder . " (Already exists)";
    }
}

echo "<h2>System Folder Diagnostic & Fix Tool</h2>";
echo "Base Path: " . $base . "<br><br>";
echo "Status:<br>";
foreach ($created as $status) {
    echo "- " . $status . "<br>";
}
echo "<br><b>If everything says Created or Already exists, you can safely upload your files now!</b>";
?>
