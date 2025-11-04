<?php
session_start();

if (isset($_SESSION['loginok']) && $_SESSION['loginok'] === true && isset($_SESSION['user'])) {
    echo "Bienvenido, " . htmlspecialchars($_SESSION['user']) . "!";
} else {
    header("Location: login.php");
    exit();
}
?>
