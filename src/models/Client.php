<?php
/**
 * Modèle Client - Gestion des clients
 */

class Client {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function create($nom, $prenom, $email, $telephone) {
        // Vérifier si le client existe déjà
        $existing = $this->getByEmail($email);
        if ($existing) {
            return $existing['id'];
        }
        
        $stmt = $this->db->prepare("
            INSERT INTO clients (nom, prenom, email, telephone) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$nom, $prenom, $email, $telephone]);
        return $this->db->lastInsertId();
    }
    
    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM clients ORDER BY nom, prenom");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}