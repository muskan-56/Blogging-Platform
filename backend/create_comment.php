<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $post_id = $_POST['post_id'];
        $content = $_POST['content'];

        $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$post_id, $user_id, $content])) {
            echo "Comment added!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Please log in to comment.";
    }
}
?>