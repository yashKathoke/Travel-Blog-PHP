<?php
session_start();
include 'db_connection.php'; // Adjust the path as needed

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Prepare the SQL query to insert the comment
    $sql = "INSERT INTO comments (comment, post_id, user_id, date) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    
    // Execute the statement
    if ($stmt->execute([$comment, $post_id, $user_id])) {
        header("Location: /assignment/pages/blog.php?id=$post_id"); // Redirect back to the blog post
        exit();
    } else {
        // Handle error (optional)
        echo "Error submitting comment.";
    }
} else {
    // If the user is not logged in
    header("Location: /assignment/pages/login.php");
    exit();
}
?>
