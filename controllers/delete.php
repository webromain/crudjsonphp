<?php

    include '../config/db.php';

    function _delete($parse, $ids) {

        if (preg_match("/^\d+(,\s?\d+)*$/", $ids)) {
            $ids = str_replace(' ', '', $ids); // Supprime les espaces éventuels
            $idArray = explode(",", $ids);
        } else {
            echo "<p class='message'>Erreur : Caractère incorrect</p>";
            return;
        }

        if ((count($parse) - count($idArray)) < 21) {
            echo "<p class='message'>Pour des raisons de sécurité, la BDD ne doit pas contenir moins de 20 personnes</p>";
            return;
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
                echo "<p class='message'>Erreur : ID.#". htmlspecialchars($valeur). " non trouvé.</p>";
                return;
            }
        }

        // Encodage en JSON et sauvegarde dans le fichier
        $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "/../bdd.json", $contenu_json);

        echo "<p class='message'>ID.#". htmlspecialchars($ids). " a été supprimé avec succès.</p>";

        header('Location: /index.php'); 
    }

    _delete(
        $parse,
        $_POST['id']
    );

?>