<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="..\style.css">
    <title>CRUD</title>
</head>
<body>
    
    <table class="table table-striped table-dark">
        <thead class="top">
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

                //Charger le fichier JSON
                if (!file_exists("..\bdd.json")) {
                    echo "<p class='message'>Erreur : Le fichier bdd.json n'existe pas.</p>";
                    return;
                }

                $json = file_get_contents("..\bdd.json");
                $parse = json_decode($json);

                // Vérifier si le JSON est valide
                if ($parse === null) {
                    echo "<p class='message'>Erreur : Impossible de décoder le fichier JSON.</p>";
                    return;
                }

                function _delete($parse, $id = int){

                    // Vérification si l'ID existe dans le JSON
                    if ($id+1 > count($parse)) {
                        echo "<p class='message'>Erreur : ID non trouvé.</p>";
                        return;
                    }

                    // Supprimer l'id demandé
                    array_splice($parse, $id, 1);

                    // Encodage en JSON et sauvegarde dans le fichier
                    $contenu_json = json_encode($parse, JSON_PRETTY_PRINT);
                    file_put_contents("..\bdd.json", $contenu_json);

                    echo "<p class='message'>ID.#". $id ." was deleted successfully.</p>";
                }

                _delete(
                    $parse,
                    $_POST['id']
                );

                $json = file_get_contents("..\bdd.json");
                $parse = json_decode($json);
                $i = 0;
                
                foreach ($parse as $valeur) {
                    echo "<tr>";
                    echo "<th scope='row'>". $i. "</th>";
                    echo "<td>". htmlspecialchars($valeur->name ?? 'N/A'). "</td>";
                        echo "<td>". htmlspecialchars($valeur->age ?? 'N/A'). "</td>";
                        echo "<td>". htmlspecialchars($valeur->role ?? 'N/A'). "</td>";
                        echo "<td>". htmlspecialchars($valeur->occupation ?? 'N/A'). "</td>";
                        echo "<td>". htmlspecialchars($valeur->activated ?? 'N/A'). "</td>";
                        echo "</tr>";
                    $i++;
                }

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
                        <label for="activated">Activated<span class="rouge">*</span></label>
                        <select name="activated" id="activated" required>
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
                        <input type="number" name="id" id="id" placeholder="3">
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
                            <option value="any">Any</option>
                            <option value="true">True</option>
                            <option value="">False</option>
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
                        <input type="number" name="id" id="id" required placeholder="3">
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
                        <input type="number" name="id" id="id" required placeholder="3">
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
    <script src="..\script.js"></script>
    
</body>
</html>