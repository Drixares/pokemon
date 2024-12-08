<?php
session_start();

if ($_POST['action'] && $_POST['action'] === "logout") {
    $_SESSION = array();
    header("Location: index.php");
    session_destroy();
    exit();
}


?>