<?php
/**
 * Modèle Reservation - Gestion des réservations
 */

class Reservation {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT r.*, c.nom, c.prenom, c.email, c.telephone
            FROM reservations r
            JOIN clients c ON r.id_client = c.id
            ORDER BY r.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT r.*, c.nom, c.prenom, c.email, c.telephone
            FROM reservations r
            JOIN clients c ON r.id_client = c.id
            WHERE r.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function create($clientId, $dateDebut, $dateFin, $total = 0) {
        $stmt = $this->db->prepare("
            INSERT INTO reservations (id_client, date_debut, date_fin, total) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$clientId, $dateDebut, $dateFin, $total]);
        return $this->db->lastInsertId();
    }
    
    public function updateStatus($id, $statut) {
        $stmt = $this->db->prepare("UPDATE reservations SET statut = ? WHERE id = ?");
        return $stmt->execute([$statut, $id]);
    }
    
    public function getDetails($reservationId) {
        $stmt = $this->db->prepare("
            SELECT dr.*, p.nom as produit_nom, p.image_url
            FROM details_reservation dr
            JOIN produits p ON dr.id_produit = p.id
            WHERE dr.id_reservation = ?
        ");
        $stmt->execute([$reservationId]);
        return $stmt->fetchAll();
    }
    
    public function addDetail($reservationId, $productId, $quantite, $prixUnitaire) {
        $stmt = $this->db->prepare("
            INSERT INTO details_reservation (id_reservation, id_produit, quantite, prix_unitaire) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$reservationId, $productId, $quantite, $prixUnitaire]);
    }
    
    public function getStats() {
        $stats = [];
        
        // Nouvelles demandes
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM reservations WHERE statut = 'En attente'");
        $stmt->execute();
        $stats['nouvelles_demandes'] = $stmt->fetch()['count'];
        
        // Réservations à venir
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM reservations WHERE statut = 'Confirmée' AND date_debut >= CURDATE()");
        $stmt->execute();
        $stats['reservations_a_venir'] = $stmt->fetch()['count'];
        
        // Total produits
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM produits");
        $stmt->execute();
        $stats['total_produits'] = $stmt->fetch()['count'];
        
        return $stats;
    }
}