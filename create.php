<?php

    $name = $_POST["name"];
    $age = $_POST["age"];
    $role = $_POST["role"];
    $occupation = $_POST["occupation"];
    $activated = $_POST["activated"];

    function _add($name = str, $age = int, $role = str, $occupation = str, $activated = bool){
        $json = file_get_contents("bdd.json");
        $parse = json_decode($json);
        
        // Vérifier si le JSON est valide
        if ($parse === null) {
            echo "<p class='message'>Erreur : Impossible de décoder le fichier JSON.\n</p>";
            return;
        }

        if ($activated == "true") {
            $activated = true;
        }
        else {
            $activated = false;
        }

        array_push($parse, ["id" => count($parse), "name" => $name, "age" => $age, "role" => $role, "occupation" => $occupation, "activated" => $activated]);
        // Encodage en JSON et sauvegarde dans le fichier
        $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
        file_put_contents("bdd.json", $contenu_json);
        echo "<p class='message'>ID.#". count($parse)-1 ." was created successfully.\n</p>";
    } _add($name, $age, $role, $occupation, $activated);

    header("location: index.php");

?>