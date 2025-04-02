<?php

require_once "config/path.php";
require_once "layouts/head.php";
require_once "layouts/header.php";

session_start(); // Démarrer la session

// Afficher le message s'il existe
if (isset($_SESSION['message'])) {
    echo "<p class='message'>" . htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8') . "</p>";
    unset($_SESSION['message']); // Supprimer le message après l'affichage
}

require_once "controllers/read.php";
require_once "layouts/footer.php";

?>