<?php
/**
 * Contrôleur Reservation - Gestion des réservations
 */

require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Client.php';

class ReservationController {
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /cart');
            exit;
        }
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
        $prenom = htmlspecialchars(trim($_POST['prenom'] ?? ''));
        $quartier = htmlspecialchars(trim($_POST['quartier'] ?? ''));
        $telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
        
        $cart = $_SESSION['cart'] ?? [];
        
        if (empty($cart) || !$nom || !$prenom || !$quartier || !$telephone) {
            $_SESSION['error'] = "Veuillez remplir tous les champs et avoir des articles dans votre panier.";
            header('Location: /cart');
            exit;
        }
        
        try {
            $clientModel = new Client();
            $reservationModel = new Reservation();
            
            // Créer le client avec email généré depuis le quartier
            $email = strtolower(str_replace(' ', '', $prenom . $nom)) . '@client.local';
            $clientId = $clientModel->create($nom, $prenom, $email, $telephone);
            
            // Calculer le total et créer la réservation
            $total = 0;
            $dateDebut = $cart[0]['date_debut'];
            $dateFin = $cart[0]['date_fin'];
            
            // Calculer le nombre de jours
            $debut = new DateTime($dateDebut);
            $fin = new DateTime($dateFin);
            $jours = $debut->diff($fin)->days + 1;
            
            foreach ($cart as $item) {
                $total += $item['prix_location_jour'] * $item['quantity'] * $jours;
            }
            
            // Créer la réservation
            $reservationId = $reservationModel->create($clientId, $dateDebut, $dateFin, $total);
            
            // Ajouter les détails
            foreach ($cart as $item) {
                $reservationModel->addDetail(
                    $reservationId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['prix_location_jour']
                );
            }
            
            // Vider le panier
            unset($_SESSION['cart']);
            
            // Récupérer les données de la réservation pour la page de succès
            $reservation = $reservationModel->getById($reservationId);
            
            header('Location: /reservation-success?id=' . $reservationId);
            exit;
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue lors de la création de votre réservation.";
            header('Location: /cart');
            exit;
        }
    }
    
    public function success() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            header('Location: /');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservation = $reservationModel->getById($id);
        
        if (!$reservation) {
            header('Location: /');
            exit;
        }
        
        $title = 'Réservation confirmée - Location de matériel événementiel';
        include __DIR__ . '/../views/public/reservation_success.php';
    }
}