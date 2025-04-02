<?php

define("BASE_URL", ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') ? "/" : $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/sites/crudjsonphp_2024/');
define("BASE_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR); // Chemin absolu du projet

?>