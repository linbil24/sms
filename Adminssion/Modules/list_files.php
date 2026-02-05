<?php
// Scan Modules directory to see real files
$dir = 'c:\xampp\htdocs\sms\Adminssion\Modules';
$files = scandir($dir);
echo "<h3>Actual Files in Modules:</h3><ul>";
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<li>$file</li>";
    }
}
echo "</ul>";
?>
