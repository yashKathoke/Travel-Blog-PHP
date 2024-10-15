<?php
session_start();
include '../php/db_connection.php'; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';


if (!in_array($action, ['like', 'dislike', 'undo_like', 'undo_dislike'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
    exit();
}


if ($action === 'like') {
    $query = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
} else if ($action === 'dislike') {
    $query = "UPDATE posts SET dislikes = dislikes + 1 WHERE id = ?";
} else if ($action === 'undo_like') {
    $query = "UPDATE posts SET likes = likes - IF(likes > 0, 1, 0) WHERE id = ?";
} else if ($action === 'undo_dislike') {
    $query = "UPDATE posts SET dislikes = dislikes - IF(dislikes > 0, 1, 0) WHERE id = ?";
}

$stmt = $pdo->prepare($query);
$stmt->execute([$post_id]);


$query = "SELECT likes, dislikes FROM posts WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$post_id]);
$updated_post = $stmt->fetch();

echo json_encode(['status' => 'success', 'likes' => $updated_post['likes'], 'dislikes' => $updated_post['dislikes']]);
?>
