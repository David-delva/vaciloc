-- Script de configuration MySQL pour VACILOC sur VPS
-- À exécuter en tant que root MySQL

-- 1. Créer la base de données
CREATE DATABASE IF NOT EXISTS vaciloc_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 2. Créer l'utilisateur
CREATE USER IF NOT EXISTS 'vaciloc_user'@'localhost' IDENTIFIED BY 'CHANGEZ_CE_MOT_DE_PASSE';

-- 3. Accorder tous les privilèges
GRANT ALL PRIVILEGES ON vaciloc_db.* TO 'vaciloc_user'@'localhost';

-- 4. Appliquer les changements
FLUSH PRIVILEGES;

-- 5. Utiliser la base de données
USE vaciloc_db;

-- 6. Importer les tables (contenu de location.sql)
-- Exécutez ensuite: mysql -u root -p vaciloc_db < location.sql
