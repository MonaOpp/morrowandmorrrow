<?php
// Temporary file to check PHP settings on live server
// DELETE this file after checking - it's a security risk to leave it

echo "<h2>PHP Upload Settings</h2>";
echo "Upload Max Filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "Post Max Size: " . ini_get('post_max_size') . "<br>";
echo "Memory Limit: " . ini_get('memory_limit') . "<br>";
echo "Max Execution Time: " . ini_get('max_execution_time') . "<br>";
echo "Max Input Vars: " . ini_get('max_input_vars') . "<br>";

// Show full PHP info (comment out for security)
// phpinfo();
?>