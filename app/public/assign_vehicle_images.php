<?php
// Load WordPress environment
require_once('wp-load.php');

// HARDCODE the correct base URL based on your working port
$base_url = 'http://localhost:10016';
$images_dir = '/wp-content/uploads/2026/02/';

// Mapping of Post ID to Image Filename
$mapping = [
    10 => 'toyota-camry-2019.png',
    11 => 'honda-crv-2020.png',
    12 => 'ford-explorer-2018.png',
    34 => 'mercedes-sprinter-2018.png',
    38 => 'caterpillar-320d.png'
];

echo "<h1>Forcing Update of Vehicle Images</h1>";
echo "<p>Using Base URL: <strong>$base_url</strong></p>";

foreach ($mapping as $post_id => $filename) {
    echo "<hr>";
    echo "<h3>Processing Post ID: $post_id ($filename)</h3>";

    // Construct new correct URL
    $new_image_url = $base_url . $images_dir . $filename;

    // Get post
    $post = get_post($post_id);
    if (!$post) {
        echo "<span style='color:red;'>Error: Post ID $post_id not found.</span><br>";
        continue;
    }

    // Debug current value
    $old_val = get_post_meta($post_id, 'vehicle_demo_image', true);
    echo "Old Value: " . htmlspecialchars($old_val) . "<br>";

    // FORCE UPDATE
    $updated = update_post_meta($post_id, 'vehicle_demo_image', $new_image_url);

    if ($updated) {
        echo "<span style='color:green; font-weight:bold;'>SUCCESS: Updated to $new_image_url</span><br>";
    } else {
        // If update returns false, check if it's because values match
        if ($old_val === $new_image_url) {
            echo "<span style='color:green;'>Value was already correct matches new URL.</span><br>";
        } else {
            echo "<span style='color:red;'>Update failed for unknown reason. DB Return: False</span><br>";
        }
    }
}

echo "<h2>Update Complete. Please check your homepage.</h2>";
?>