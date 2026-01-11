<?php
/**
 * Configuration de la base de données
 */

define('DB_HOST', 'localhost:3307');
define('DB_NAME', 'Location');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configuration de session
define('SESSION_NAME', 'location_session');
define('SESSION_LIFETIME', 3600); // 1 heure

// Configuration générale
define('BASE_URL', 'http://localhost/location/');
define('UPLOAD_PATH', __DIR__ . '/../public/images/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB