<?php

require_once '../config/db.php';
require_once '../config/path.php';
session_start();

function _create($parse, $name, $age, $role, $occupation, $activated) {
    if (count($parse) > 50) {
        $_SESSION['message'] = "Pour des raisons de sécurité, la BDD ne doit pas contenir plus de 50 personnes.";
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }

    // Validation et assainissement des entrées
    $name = htmlspecialchars(trim($name));
    $age = filter_var($age, FILTER_VALIDATE_INT);
    $role = htmlspecialchars(trim($role));
    $occupation = htmlspecialchars(trim($occupation));
    $activated = filter_var($activated, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    if ($name === "" || $age === false || $role === "" || $occupation === "" || $activated === null) {
        $_SESSION['message'] = "Erreur : Données invalides.";
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }

    // Créer la nouvelle entrée à la suite de la BDD
    $newId = end($parse)->id + 1;
    array_push($parse, ["id" => $newId, "name" => $name, "age" => $age, "role" => $role, "occupation" => $occupation, "activated" => $activated]);

    // Encodage en JSON et sauvegarde dans le fichier
    $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../bdd.json", $contenu_json);

    $_SESSION['message'] = "ID.#" . htmlspecialchars($newId) . " a été créé avec succès.";
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}

_create(
    $parse,
    $_POST['name'] ?? null,
    $_POST['age'] ?? null,
    $_POST['role'] ?? null,
    $_POST['occupation'] ?? null,
    $_POST['activated'] ?? null
);

?>