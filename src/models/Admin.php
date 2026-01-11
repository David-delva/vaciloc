<?php
/**
 * Modèle Admin - Gestion des administrateurs
 */

class Admin {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM administrateurs WHERE nom_utilisateur = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['mot_de_passe_hash'])) {
            return $admin;
        }
        
        return false;
    }
    
    public function create($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO administrateurs (nom_utilisateur, mot_de_passe_hash) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }
    
    public function updatePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE administrateurs SET mot_de_passe_hash = ? WHERE id = ?");
        return $stmt->execute([$hashedPassword, $id]);
    }
}