<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$username, $password, $email])) {
        header('Location: http://localhost/Bloging_Website_2/frontend/login.html');
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>