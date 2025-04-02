<?php

require_once '../config/db.php';
require_once '../config/path.php';
session_start();

function _update($parse, $id, $name, $age, $role, $occupation, $activated) {
    // Vérification si l'ID existe dans le JSON
    $found = false;
    foreach ($parse as $index => $user) {
        if ($user->id == $id) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['message'] = "Erreur : ID.#" . htmlspecialchars($id) . " non trouvé.";
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }

    // Mise à jour des données
    if ($name == "") {
        $name = $user->name;
    }
    if ($age == "") {
        $age = $user->age;
    }
    if ($role == "") {
        $role = $user->role;
    }
    if ($occupation == "") {
        $occupation = $user->occupation;
    }
    if ($activated == "any") {
        $activated = $user->activated;
    }
    if ($activated == "true") {
        $activated = true;
    } else {
        $activated = false;
    }

    // Mise à jour des données de l'utilisateur
    $user->name = $name;
    $user->age = $age;
    $user->role = $role;
    $user->occupation = $occupation;
    $user->activated = $activated;

    // Encodage en JSON et sauvegarde dans le fichier
    $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../bdd.json", $contenu_json);

    $_SESSION['message'] = "ID.#" . htmlspecialchars($id) . " a été mis à jour avec succès.";
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}

_update(
    $parse,
    $_POST['id'],
    $_POST['name'] ?? null,
    $_POST['age'] ?? null,
    $_POST['role'] ?? null,
    $_POST['occupation'] ?? null,
    $_POST['activated']
);

?>