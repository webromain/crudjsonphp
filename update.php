<?php

    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $role = $_POST["role"];
    $occupation = $_POST["occupation"];
    $activated = $_POST["activated"];

    function _update($id = int, $name = str, $age = int, $role = str, $occupation = str, $activated = bool) {
        // Charger le fichier JSON
        $json = file_get_contents("bdd.json");
        $parse = json_decode($json, true); // Décoder en tableau associatif

        // Vérifier si le JSON est valide
        if ($parse === null) {
            echo "<p class='message'>Erreur : Impossible de décoder le fichier JSON.\n</p>";
            return;
        }
    
        // Vérification si l'ID existe dans le JSON
        if (!isset($parse[$id])) {
            echo "<p class='message'>Erreur : ID non trouvé.\n</p>";
            return;
        }

        if ($name == "") {
            $name = $parse[$id]['name'];
        }
        if ($age == "") {
            $age = $parse[$id]['age'];
        }
        if ($role == "") {
            $role = $parse[$id]['role'];
        }
        if ($occupation == "") {
            $occupation = $parse[$id]['occupation'];
        }
        if ($activated == "") {
            $activated = $parse[$id]['activated'];
        }
        if ($activated == "true") {
            $activated = true;
        }
        else {
            $activated = false;
        }
    
        // Mise à jour des données
        $parse[$id] = [
            "name" => $name,
            "age" => (int)$age, // Conversion explicite en entier
            "role" => $role,
            "occupation" => $occupation,
            "activated" => (bool)$activated // Conversion explicite en booléen
        ];
    
        // Encodage en JSON et sauvegarde dans le fichier
        $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
        file_put_contents("bdd.json", $contenu_json);
    
        // Optionnel : Affichage ou appel d'une autre fonction (comme _list)
        echo "<p class='message'>Successful Update.\n</p>";
    } _update($id, $name, $age, $role, $occupation, $activated);

    header("location: index.php");

?>