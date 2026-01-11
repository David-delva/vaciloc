<?php
/**
 * Modèle Category - Gestion des catégories
 */

class Category {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT c.*, COUNT(p.id) as nb_produits 
            FROM categories c 
            LEFT JOIN produits p ON c.id = p.id_categorie 
            GROUP BY c.id 
            ORDER BY c.nom
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function create($nom) {
        $stmt = $this->db->prepare("INSERT INTO categories (nom) VALUES (?)");
        return $stmt->execute([$nom]);
    }
    
    public function update($id, $nom) {
        $stmt = $this->db->prepare("UPDATE categories SET nom = ? WHERE id = ?");
        return $stmt->execute([$nom, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }
}