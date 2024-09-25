<?php
$jsonFile = '../blogs.json';
$success = false;

function uploadImage() {
    $target_dir = "../public/images/";
    $timestamp = time(); 
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $newFileName = "img_" . $timestamp . "." . $imageFileType;
    $target_file = $target_dir . $newFileName;
    $uploadOk = 1;

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            return $newFileName;
        } else {
            return false;
        }
    }
}

function createPost(){
    $uniqueId = uniqid();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $auther = $_POST['author'];
    $submittedAt = date('Y-m-d H:i:s');
    $jsonFile = '../blogs.json';
    $image_path = uploadImage();

    $newPost = array(
        "title" => $title,
        "content" => $content,
        "date" => $submittedAt,
        "image" => $image_path,
        "id" => $uniqueId,
    );

    if (file_exists($jsonFile)) {
        $jsonData = file_get_contents($jsonFile);
        $blogPosts = json_decode($jsonData, true);
        if ($blogPosts === null) {
            $blogPosts = array();
        }
    } else {
        $blogPosts = array();
    }

    array_push($blogPosts, $newPost);
    $updatedJsonData = json_encode($blogPosts, JSON_PRETTY_PRINT);

    if (file_put_contents($jsonFile, $updatedJsonData)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $success = createPost();
}
?>

<script>
    let success = <?php echo json_encode($success); ?>;
    if (success) {
        setTimeout(function(){
            window.location.href = '/assignment'; 
        }, 200);
    }
</script>
