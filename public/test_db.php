<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    echo "✅ Connexion MySQL réussie<br>";
    
    // Vérifier si la base existe
    $stmt = $pdo->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Base de données '" . DB_NAME . "' existe<br>";
        
        // Se connecter à la base
        $pdo->exec("USE " . DB_NAME);
        
        // Vérifier les tables
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "✅ Tables trouvées: " . implode(', ', $tables) . "<br>";
        
    } else {
        echo "❌ Base de données '" . DB_NAME . "' n'existe pas<br>";
        echo "👉 Exécutez le fichier location.sql pour créer la base<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage();
}
