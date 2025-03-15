<section class="secbtns">
    <div>
        <button type="button" class="btn btn-secondary" id="create-btn"><span id="create-btn">CREATE</span></button>
        <div class="submenu" id="create-submenu">
            <form method="post" action="controllers/create.php">
                <h3>Add</h3>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
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
                        <input type="submit" value="POST" class="animate__animated animate__pulse animate__infinite animate__slow">
                </div>
            </form>
        </div>

        <button type="button" class="btn btn-secondary" id="read-btn">READ</button>
        <div class="submenu" id="read-submenu">
            <form method="get" action="../index.php">
                <h3>List</h3>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
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
                        <option value="any">Any</option>
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>

                <div class="inp">
                    <input type="reset" value="Effacer">
                    <input type="submit" value="GET" class="animate__animated animate__pulse animate__infinite animate__slow">
                </div>
            </form>
        </div>

        <button type="button" class="btn btn-secondary" id="update-btn">UPDATE</button>
        <div class="submenu" id="update-submenu">
            <form method="post" action="controllers/update.php">
                <h3>Update</h3>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
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
                        <option value="any">Any</option>
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>
                    
                <div class="inp">
                        <input type="reset" value="Effacer">
                        <input type="submit" value="POST" class="animate__animated animate__pulse animate__infinite animate__slow">
                </div>
            </form>
        </div>

        <button type="button" class="btn btn-secondary" id="delete-btn">DELETE</button>
        <div class="submenu" id="delete-submenu" >
            <form method="post" action="controllers/delete.php">
                <h3>Delete</h3>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                <div>
                    <label for="id">Id<span class="rouge">*</span></label>
                    <input type="text" name="id" id="id" required placeholder="3,5,14,1,...">
                </div>

                <div class="inp">
                        <input type="reset" value="Effacer">
                        <input type="submit" value="POST" class="animate__animated animate__pulse animate__infinite animate__slow">
                </div>
            </form>
        </div>
    </div>
</section>