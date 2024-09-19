<?php
// File where blog posts are stored
$jsonFile = '../blogs.json';
$success = false;


function uploadImage() {
    $target_dir = "../public/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Get the current timestamp
        $timestamp = time();  // Current Unix timestamp

        // Get the original file extension
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    
        // Generate a new filename using the timestamp
        $newFileName = "img_" . $timestamp . "." . $imageFileType;
    
        // Set the full path to save the file
        $target_file = $target_dir . $newFileName;
    
        $uploadOk = 1;
    
        echo $newFileName . "<br>";
    // Check if image file is a real image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // If the file is not valid
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return false;  // Return false if the upload was unsuccessful
    } else {
        // Try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            return $newFileName;  // Return the file path on success
        } else {
            echo "Sorry, there was an error uploading your file.";
            return false;  // Return false on failure
        }
    }
}


 function createPost(){

     // Get the posted blog title and content
     $uniqueId = uniqid();
     $title = $_POST['title'];
     $content = $_POST['content'];
     $auther = $_POST['author'];
     $submittedAt = date('Y-m-d H:i:s');
     // File where blog posts are stored
$jsonFile = '../blogs.json';
 
    $image_path = uploadImage();
    echo $image_path;
     // Create a new blog post as an associative array
     $newPost = array(
         "title" => $title,
         "content" => $content,
         "date" => $submittedAt,
         "image" => $image_path,
         "id" => $uniqueId,
     );
 
    
 
     if (file_exists($jsonFile)) {
         // Read the existing blog posts
         $jsonData = file_get_contents($jsonFile);
         $blogPosts = json_decode($jsonData, true);

         if ($blogPosts === null) {
            $blogPosts = array();
        }
     } else {
         $blogPosts = array();
     }
 
     // Append the new post to the array
     array_push($blogPosts, $newPost);
 
     // Encode the updated array back to JSON
     $updatedJsonData = json_encode($blogPosts, JSON_PRETTY_PRINT);
 
     // Save the updated JSON data back to the file
     if (file_put_contents($jsonFile, $updatedJsonData)) {
        //  echo "Blog post added successfully!";
         return true;
     } else {
        //  echo "Failed to add blog post.";
         return false;
     }


 }
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $success = createPost();
}




?>

<!-- Redirect back to the main page after submission -->
<script>
    let success = <?php echo json_encode($success); ?>;
    if (success) {
        
        setTimeout(function(){
            window.location.href = '/assignment'; 
        }, 200);
    }
    
</script>
