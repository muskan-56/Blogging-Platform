<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$user_id, $title, $content])) {
            header('Location: http://localhost/Bloging_Website_2/frontend/post.html');
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Please log in to create a post.";
    }
}
?>