// Récupération du bouton et du sous-menu
const createBtn = document.getElementById('create-btn');
const readBtn = document.getElementById('read-btn');
const updateBtn = document.getElementById('update-btn');
const deleteBtn = document.getElementById('delete-btn');
const createSubmenu = document.getElementById('create-submenu');
const readSubmenu = document.getElementById('read-submenu');
const updateSubmenu = document.getElementById('update-submenu');
const deleteSubmenu = document.getElementById('delete-submenu');

// Ajout d'un événement au bouton
createBtn.addEventListener('click', function () {
    // Basculer la classe "active" sur le sous-menu
    createSubmenu.classList.toggle('active');
    readSubmenu.classList.remove('active');
    updateSubmenu.classList.remove('active');
    deleteSubmenu.classList.remove('active');
});

readBtn.addEventListener('click', function () {
    // Basculer la classe "active" sur le sous-menu
    readSubmenu.classList.toggle('active');
    deleteSubmenu.classList.remove('active');
    createSubmenu.classList.remove('active');
    updateSubmenu.classList.remove('active');
});

updateBtn.addEventListener('click', function () {
    // Basculer la classe "active" sur le sous-menu
    updateSubmenu.classList.toggle('active');
    createSubmenu.classList.remove('active');
    readSubmenu.classList.remove('active');
    deleteSubmenu.classList.remove('active');
});

deleteBtn.addEventListener('click', function () {
    // Basculer la classe "active" sur le sous-menu
    deleteSubmenu.classList.toggle('active');
    createSubmenu.classList.remove('active');
    readSubmenu.classList.remove('active');
    updateSubmenu.classList.remove('active');
});