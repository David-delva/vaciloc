<?php
/**
 * Configuration de la base de données - PRODUCTION
 */

// Configuration pour VPS Production
define('DB_HOST', 'localhost');
define('DB_NAME', 'vaciloc_db');
define('DB_USER', 'vaciloc_user');
define('DB_PASS', 'CHANGEZ_CE_MOT_DE_PASSE'); // À changer lors du déploiement
define('DB_CHARSET', 'utf8mb4');

// Configuration de session
define('SESSION_NAME', 'vaciloc_session');
define('SESSION_LIFETIME', 3600); // 1 heure

// Configuration générale
define('BASE_URL', 'https://www.vaciloc.com/');
define('UPLOAD_PATH', __DIR__ . '/../public/images/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Mode développement (mettre à false en production)
define('DEBUG_MODE', false);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}