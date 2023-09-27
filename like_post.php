<?php
include('conexao.php');
include('dashboard.php');

if (isset($_POST['action']) && $_POST['action'] === 'like' && isset($_POST['post_id'])) {
    // Connect to your database
    $mysqli = new mysqli('localhost', 'root', '', 'loja');

    // Check for database connection errors
    if ($mysqli->connect_error) {
        die('Database connection error: ' . $mysqli->connect_error);
    }

    // Sanitize and get the post_id from the POST data
    $post_id = $mysqli->real_escape_string($_POST['post_id']);

    // Check if the user has already liked this post (you can use sessions or user authentication here)
    // For simplicity, we'll assume the user has not already liked the post

    // Increment the like count for the post in the database
    $update_query = "UPDATE post SET like_count = like_count + 1 WHERE id = $post_id";
    
    if ($mysqli->query($update_query) === TRUE) {
        // Successfully updated the like count
        $response = ['success' => true];
    } else {
        // Error occurred while updating the like count
        $response = ['success' => false, 'message' => 'Error updating like count'];
    }

    // Close the database connection
    $mysqli->close();
} else {
    $response = ['success' => false, 'message' => 'Invalid request'];
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
