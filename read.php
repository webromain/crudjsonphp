<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>CRUD</title>
</head>
<body>
    
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Âge</th>
                <th scope="col">Rôle</th>
                <th scope="col">Occupation</th>
                <th scope="col">Activated</th>
            </tr>
        </thead>
            <tbody>
                <?php

                    function _list($id = null, $name = null, $age = null, $role = null, $occupation = null, $activated = null) {
                        // Charger le fichier JSON
                        if (!file_exists("bdd.json")) {
                            echo "<tr><td colspan='6'>Erreur : Le fichier bdd.json n'existe pas.</td></tr>";
                            return;
                        }

                        $json = file_get_contents("bdd.json");
                        $parse = json_decode($json);

                        // Vérifier si le JSON est valide
                        if ($parse === null) {
                            echo "<tr><td colspan='6'>Erreur : Impossible de décoder le fichier JSON.</td></tr>";
                            return;
                        }

                        // Vérifier si le JSON est vide
                        if (empty($parse)) {
                            echo "<tr><td colspan='6'>Pas de données disponibles.</td></tr>";
                            return;
                        }

                        // Filtrer les résultats
                        $filtered_results = array_filter($parse, function ($entry) use ($id, $name, $age, $role, $occupation, $activated) {
                            // Validation des propriétés
                            if (!isset($entry->id, $entry->name, $entry->age, $entry->role, $entry->occupation, $entry->activated)) {
                                return false;
                            }
                        
                            // Comparer en tenant compte des types
                            if ($id !== null && (int)$id !== (int)$entry->id) return false;
                            if ($name !== null && stripos($entry->name, $name) === false) return false;
                            if ($age !== null && (int)$age !== (int)$entry->age) return false;
                            if ($role !== null && stripos($entry->role, $role) === false) return false;
                            if ($occupation !== null && stripos($entry->occupation, $occupation) === false) return false;
                        
                            // Convertir 'activated' en booléen pour comparaison
                            if ($activated !== null) {
                                $activated_value = filter_var($activated, FILTER_VALIDATE_BOOLEAN);
                                if ($activated_value !== $entry->activated) return false;
                            }
                        
                            return true;
                        });

                        // Afficher les résultats filtrés
                        if (empty($filtered_results)) {
                            echo "<tr><td colspan='6'>Aucun résultat trouvé avec les critères donnés.</td></tr>";
                            return;
                        }

                        foreach ($filtered_results as $entry) {
                            echo "<tr>";
                            echo "<th scope='row'>" . htmlspecialchars($entry->id) . "</th>";
                            echo "<td>" . htmlspecialchars($entry->name) . "</td>";
                            echo "<td>" . htmlspecialchars($entry->age) . "</td>";
                            echo "<td>" . htmlspecialchars($entry->role) . "</td>";
                            echo "<td>" . htmlspecialchars($entry->occupation) . "</td>";
                            echo "<td>" . ($entry->activated ? "True" : "False") . "</td>";
                            echo "</tr>";
                        }
                    }

                    _list(
                        $_POST['id'] ?? null,
                        $_POST['name'] ?? null,
                        $_POST['age'] ?? null,
                        $_POST['role'] ?? null,
                        $_POST['occupation'] ?? null,
                        $_POST['activated'] ?? null
                    );
                    

                ?>
            </tbody>
    </table>

    <section class="secbtns">
        <div>
            <button type="button" class="btn btn-secondary" id="create-btn"><span id="create-btn">CREATE</span></button>
            <div class="submenu" id="create-submenu">
                <form method="post" action="create.php">
                    <h3>Add</h3>
                    <div>
                        <label for="name">Nom<span class="rouge">*</span></label>
                        <input type="text" name="name" id="name" required placeholder="Jean">
                    </div>
                    <div>
                        <label for="age">Age<span class="rouge">*</span></label>
                        <input type="number" name="age" id="age" required placeholder="34">
                    </div>
                    <div>
                        <label for="role">Role<span class="rouge">*</span></label>
                        <input type="text" name="role" id="role" required placeholder="Reader">
                    </div>
                    <div>
                        <label for="occupation">Occupation<span class="rouge">*</span></label>
                        <input type="text" name="occupation" id="occupation" required placeholder="Designer">
                    </div>
                    <div>
                        <label for="activated">Activated</label>
                        <select name="activated" id="activated" required>
                            <option value="">Any</option>
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                        
                    <div class="inp">
                            <input type="reset" value="Effacer">
                            <input type="submit" value="Post" class="animate__animated animate__pulse animate__infinite animate__slow">
                    </div>
                </form>
            </div>

            <button type="button" class="btn btn-secondary" id="read-btn">READ</button>
            <div class="submenu" id="read-submenu">
                <form method="post" action="read.php">
                    <h3>List</h3>
                    <div>
                        <label for="id">Id</label>
                        <input type="text" name="id" id="id" placeholder="3">
                    </div>
                    <div>
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" placeholder="Jean">
                    </div>
                    <div>
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" placeholder="34">
                    </div>
                    <div>
                        <label for="role">Role</label>
                        <input type="text" name="role" id="role" placeholder="Reader">
                    </div>
                    <div>
                        <label for="occupation">Occupation</label>
                        <input type="text" name="occupation" id="occupation" placeholder="Designer">
                    </div>
                    <div>
                        <label for="activated">Activated</label>
                        <select name="activated" id="activated">
                            <option value="">Any</option>
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>

                    <div class="inp">
                        <input type="reset" value="Effacer">
                        <input type="submit" value="Post" class="animate__animated animate__pulse animate__infinite animate__slow">
                    </div>
                </form>
            </div>

            <button type="button" class="btn btn-secondary" id="update-btn">UPDATE</button>
            <div class="submenu" id="update-submenu">
                <form method="post" action="update.php">
                    <h3>Update</h3>
                    <div>
                        <label for="id">Id<span class="rouge">*</span></label>
                        <input type="text" name="id" id="id" required placeholder="3">
                    </div>
                    <div>
                        <label for="name">Nom</label>
                        <input type="text" name="name" id="name" placeholder="Jean">
                    </div>
                    <div>
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" placeholder="34">
                    </div>
                    <div>
                        <label for="role">Role</label>
                        <input type="text" name="role" id="role" placeholder="Reader">
                    </div>
                    <div>
                        <label for="occupation">Occupation</label>
                        <input type="text" name="occupation" id="occupation" placeholder="Designer">
                    </div>
                    <div>
                        <label for="activated">Activated</label>
                        <select name="activated" id="activated">
                            <option value="">Any</option>
                            <option value="true">True</option>
                            <option value="false">False</option>
                        </select>
                    </div>
                        
                    <div class="inp">
                            <input type="reset" value="Effacer">
                            <input type="submit" value="Post" class="animate__animated animate__pulse animate__infinite animate__slow">
                    </div>
                </form>
            </div>

            <button type="button" class="btn btn-secondary" id="delete-btn">DELETE</button>
            <div class="submenu" id="delete-submenu" >
                <form method="post" action="delete.php">
                    <h3>Delete</h3>
                    <div>
                        <label for="id">Id<span class="rouge">*</span></label>
                        <input type="text" name="id" id="id" required placeholder="3">
                    </div>

                    <div class="inp">
                            <input type="reset" value="Effacer">
                            <input type="submit" value="Post" class="animate__animated animate__pulse animate__infinite animate__slow">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    
</body>
</html>