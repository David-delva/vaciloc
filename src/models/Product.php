<?php
/**
 * Modèle Product - Gestion des produits
 */

class Product {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT p.*, c.nom as categorie_nom 
            FROM produits p 
            JOIN categories c ON p.id_categorie = c.id 
            ORDER BY p.nom
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.nom as categorie_nom 
            FROM produits p 
            JOIN categories c ON p.id_categorie = c.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getByCategory($categoryId) {
        $stmt = $this->db->prepare("
            SELECT p.*, c.nom as categorie_nom 
            FROM produits p 
            JOIN categories c ON p.id_categorie = c.id 
            WHERE p.id_categorie = ?
            ORDER BY p.nom
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }
    
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO produits (nom, description, prix_location_jour, quantite_totale, id_categorie, image_url) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $data['prix_location_jour'],
            $data['quantite_totale'],
            $data['id_categorie'],
            $data['image_url']
        ]);
    }
    
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE produits 
            SET nom = ?, description = ?, prix_location_jour = ?, quantite_totale = ?, id_categorie = ?, image_url = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $data['prix_location_jour'],
            $data['quantite_totale'],
            $data['id_categorie'],
            $data['image_url'],
            $id
        ]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produits WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function getAvailableQuantity($productId, $dateDebut, $dateFin) {
        $stmt = $this->db->prepare("
            SELECT p.quantite_totale - COALESCE(SUM(dr.quantite), 0) as disponible
            FROM produits p
            LEFT JOIN details_reservation dr ON p.id = dr.id_produit
            LEFT JOIN reservations r ON dr.id_reservation = r.id
            WHERE p.id = ? 
            AND r.statut IN ('Confirmée', 'En attente')
            AND ((r.date_debut <= ? AND r.date_fin >= ?) OR (r.date_debut <= ? AND r.date_fin >= ?))
        ");
        $stmt->execute([$productId, $dateDebut, $dateDebut, $dateFin, $dateFin]);
        $result = $stmt->fetch();
        return $result ? $result['disponible'] : 0;
    }
}