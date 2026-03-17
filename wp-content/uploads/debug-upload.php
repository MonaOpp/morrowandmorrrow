<?php
// Check WordPress upload limits and errors
if (isset($_FILES)) {
    echo "<h3>Upload Attempt Debug Info:</h3>";
    echo "Upload Max Filesize: " . wp_max_upload_size() . " bytes (" . size_format(wp_max_upload_size()) . ")<br>";
    echo "PHP Upload Max: " . ini_get('upload_max_filesize') . "<br>";
    echo "PHP Post Max: " . ini_get('post_max_size') . "<br>";
    echo "Memory Limit: " . ini_get('memory_limit') . "<br>";
}

// Add this to your active theme's functions.php temporarily to see upload errors
add_action('admin_notices', function() {
    if (isset($_GET['upload_error'])) {
        echo '<div class="notice notice-error"><p>Upload Error Code: ' . sanitize_text_field($_GET['upload_error']) . '</p></div>';
    }
});
?>