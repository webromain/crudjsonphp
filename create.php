<?php

    $name = $_POST["name"];
    $age = $_POST["age"];
    $role = $_POST["role"];
    $occupation = $_POST["occupation"];
    $activated = $_POST["activated"];
    
    if ($activated == "true") {
        $activ = true;
    }
    else {
        $activ = false;
    }

    function _add($name = str, $age = int, $role = str, $occupation = str, $activated = bool){
        $json = file_get_contents("bdd.json");
        $parse = json_decode($json);

        array_push($parse, ["id" => count($parse), "name" => $name, "age" => $age, "role" => $role, "occupation" => $occupation, "activated" => $activated]);
        // Encodage en JSON et sauvegarde dans le fichier
        $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
        file_put_contents("bdd.json", $contenu_json);
        echo "<p class='message'>ID.#". count($parse)-1 ." was created successfully.\n</p>";
    } _add($name, $age, $role, $occupation, $activ);

    header("location: index.php");

?>