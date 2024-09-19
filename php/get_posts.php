<?php
// File where blog posts are stored
$jsonFile = '../blogs.json';
$success = false;



function getPosts(){
    $jsonFile = '../blogs.json';
    $data = json_decode(file_get_contents($jsonFile), true);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
   $data = getPosts();
   echo json_encode($data);
   exit;
}


?>

<!-- Redirect back to the main page after submission -->
<script>
    if ($success) {
        
        setTimeout(function(){
            window.location.href = '/assignment'; // The main page that displays all posts
        }, 200);
    }
    
</script>
