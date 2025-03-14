<?php

    include './config/db.php';

    function _read($parse, $id, $name, $age, $role, $occupation, $activated) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;
            $name = $_GET['name'] ?? null;
            $age = $_GET['age'] ?? null;
            $role = $_GET['role'] ?? null;
            $occupation = $_GET['occupation'] ?? null;
            $activated = $_GET['activated'] ?? 'any';

            include './config/db.php';

            $results = array_filter($parse, function ($entry) use ($id, $name, $age, $role, $occupation, $activated) {
                $activatedCondition = ($activated === 'any') || ($activated === 'true' && $entry->activated) || ($activated === 'false' && !$entry->activated);
                return (!$id || $entry->id == $id) &&
                    (!$name || $entry->name == $name) &&
                    (!$age || $entry->age == $age) &&
                    (!$role || $entry->role == $role) &&
                    (!$occupation || $entry->occupation == $occupation) &&
                    $activatedCondition;
            });

            foreach ($results as $valeur) {
                echo "<tr>";
                echo "<th scope='row'>". htmlspecialchars($valeur->id ?? 'N/A'). "</th>";
                echo "<td>". htmlspecialchars($valeur->name ?? 'N/A'). "</td>";
                echo "<td>". htmlspecialchars($valeur->age ?? 'N/A'). "</td>";
                echo "<td>". htmlspecialchars($valeur->role ?? 'N/A'). "</td>";
                echo "<td>". htmlspecialchars($valeur->occupation ?? 'N/A'). "</td>";
                echo "<td>". htmlspecialchars($valeur->activated ? 'True' : 'False'). "</td>";
                echo "</tr>";
            }

        } 
    }

    _read(
        $parse,
        $_GET['id'] ?? null,
        $_GET['name'] ?? null,
        $_GET['age'] ?? null,
        $_GET['role'] ?? null,
        $_GET['occupation'] ?? null,
        $_GET['activated'] ?? 'any'
    );
    

?>