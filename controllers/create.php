<?php

include_once '../config/db.php';
include_once '../config/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !verifyCsrfToken($_POST['csrf_token'])) {
        echo "<p class='message'>Erreur : Token CSRF invalide.</p>";
        return;
    }

    function _create($parse, $name, $age, $role, $occupation, $activated) {
        if (count($parse) > 50) {
            echo "<p class='message'> Pour des raisons de sécurité la bdd ne doit pas contenir plus de 50 personnes</p>";
            return;
        }

        // Validation et assainissement des entrées
        $name = htmlspecialchars(trim($name));
        $age = filter_var($age, FILTER_VALIDATE_INT);
        $role = htmlspecialchars(trim($role));
        $occupation = htmlspecialchars(trim($occupation));
        $activated = filter_var($activated, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($name === "" || $age === false || $role === "" || $occupation === "" || $activated === null) {
            echo "<p class='message'>Erreur : Données invalides.</p>";
            return;
        }

        // Créer la nouvelle entrée à la suite de la bdd
        $newId = end($parse)->id + 1;
        array_push($parse, ["id" => $newId, "name" => $name, "age" => $age, "role" => $role, "occupation" => $occupation, "activated" => $activated]);

        // Encodage en JSON et sauvegarde dans le fichier
        $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/../bdd.json", $contenu_json);

        echo "<p class='message'>ID.#". $newId ." was created successfully.</p>";

        header('Location: /index.php');
        exit();
    }

    _create(
        $parse,
        $_POST['name'] ?? null,
        $_POST['age'] ?? null,
        $_POST['role'] ?? null,
        $_POST['occupation'] ?? null,
        $_POST['activated'] ?? null
    );
}
?>