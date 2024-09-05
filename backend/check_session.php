<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: http://localhost/Bloging_Website_2/frontend/index.html');
    exit();
}
?>