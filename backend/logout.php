<?php
session_start();
session_unset();
session_destroy();
header('Location: http://localhost/Bloging_Website_2/frontend/index.html');
exit();
?>