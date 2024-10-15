<?php
// Database connection
$host = 'localhost';
$dbname = 'blog_posts'; // your database name
$user = 'root'; // your database user
$password = ''; // your database password

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// Fetch all posts from the MySQL database
$query = "SELECT * FROM posts ORDER BY date DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return posts as JSON
echo json_encode($posts);
