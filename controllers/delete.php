<?php

require_once '../config/db.php';
require_once '../config/path.php';
session_start();

function _delete($parse, $ids) {

    if (preg_match("/^\d+(,\s?\d+)*$/", $ids)) {
        $ids = str_replace(' ', '', $ids); // Supprime les espaces éventuels
        $idArray = explode(",", $ids);
    } else {
        $_SESSION['message'] = "Erreur : Caractère incorrect";
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }

    if ((count($parse) - count($idArray)) < 21) {
        $_SESSION['message'] = "Pour des raisons de sécurité, la BDD ne doit pas contenir moins de 20 personnes";
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }

    foreach ($idArray as $valeur) {
        $found = false;
        foreach ($parse as $index => $user) {
            if ($user->id == $valeur) {
                // Supprimer l'utilisateur trouvé
                array_splice($parse, $index, 1);
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['message'] = "ID.#" . htmlspecialchars($valeur) . " a été créé avec succès.";
            header('Location: ' . BASE_URL . 'index.php');
            exit;
        }
    }

    // Encodage en JSON et sauvegarde dans le fichier
    $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . "/../bdd.json", $contenu_json);


    $_SESSION['message'] = "ID.#" . htmlspecialchars($ids) . " a été supprimé avec succès.";
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}

_delete(
    $parse,
    $_POST['id']
);

?>