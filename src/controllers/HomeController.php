<?php
/**
 * Contrôleur Home - Page d'accueil
 */

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class HomeController {
    
    public function index() {
        $productModel = new Product();
        $categoryModel = new Category();
        
        $featuredProducts = array_slice($productModel->getAll(), 0, 6);
        $categories = $categoryModel->getAll();
        
        $title = "Accueil - Location de matériel événementiel";
        
        include __DIR__ . '/../views/public/home.php';
    }
    
    public function contact() {
        $title = "Contact - Location de matériel événementiel";
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
            
            if ($nom && $email && $message) {
                // Ici, vous pourriez envoyer un email ou sauvegarder le message
                $success = "Votre message a été envoyé avec succès !";
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }
        
        include __DIR__ . '/../views/public/contact.php';
    }
}