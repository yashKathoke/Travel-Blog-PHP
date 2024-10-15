<?php
session_start(); // Start the session to access user session variables

// Database connection
$host = 'localhost';
$dbname = 'blog_posts'; // your database name
$user = 'root'; // your database user
$password = ''; // your database password

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

// Function to upload image
function uploadImage() {
    $target_dir = "../public/images/";
    $timestamp = time();
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $newFileName = "img_" . $timestamp . "." . $imageFileType;
    $target_file = $target_dir . $newFileName;

    // Check if image is valid
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            return false;
        }
    }

    // Move uploaded file to images directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        return $newFileName;
    } else {
        return false;
    }
}

// Function to create post
function createPost($conn) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username']; // Use the logged-in user's username from the session
    $submittedAt = date('Y-m-d H:i:s');
    $image_path = uploadImage();

    if ($image_path === false) {
        return false;
    }

    // SQL query to insert post into MySQL database
    $sql = "INSERT INTO posts (title, author, content, image, date) VALUES (:title, :author, :content, :image, :submittedAt)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $image_path);
    $stmt->bindParam(':submittedAt', $submittedAt);

    // Execute query
    return $stmt->execute();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('You must be logged in to submit a post.');</script>";
    } else {
        $success = createPost($conn);
        
        // Redirect to homepage on successful submission
        echo "<script>
            let success = " . json_encode($success) . ";
            if (success) {
                setTimeout(function() {
                    window.location.href = '/assignment'; 
                }, 200);
            } else {
                alert('Failed to submit post. Please try again.');
            }
        </script>";
    }
}
?>
