<?php
//Charger le fichier JSON
if (!file_exists(__DIR__ . "/../bdd.json")) {
    echo "<p class='message'>Erreur : Le fichier bdd.json n'existe pas.</p>";
    return;
}

$json = file_get_contents(__DIR__ . "/../bdd.json");
$parse = json_decode($json);

// Vérifier si le JSON est valide
if ($parse === null) {
    echo "<p class='message'>Erreur : Impossible de décoder le fichier JSON.</p>";
    return;
}
?>