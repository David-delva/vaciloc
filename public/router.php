<?php
// Routeur pour le serveur de développement PHP
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Servir les fichiers statiques
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/', $uri)) {
    return false;
}

// Rediriger vers index.php
require_once 'index.php';