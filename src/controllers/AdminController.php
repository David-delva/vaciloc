<?php
/**
 * Contrôleur Admin - Panneau d'administration
 */

require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Reservation.php';

class AdminController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $password = htmlspecialchars(trim($_POST['password'] ?? ''));
            
            $adminModel = new Admin();
            $admin = $adminModel->authenticate($username, $password);
            
            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['nom_utilisateur'];
                header('Location: /admin/dashboard');
                exit;
            } else {
                $error = "Identifiants incorrects.";
            }
        }
        
        $title = "Connexion Admin";
        include __DIR__ . '/../views/admin/login.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: /admin');
        exit;
    }
    
    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin');
            exit;
        }
    }
    
    public function dashboard() {
        $this->checkAuth();
        
        $reservationModel = new Reservation();
        $stats = $reservationModel->getStats();
        $recentReservations = array_slice($reservationModel->getAll(), 0, 10);
        
        $title = "Tableau de bord - Admin";
        include __DIR__ . '/../views/admin/dashboard.php';
    }
    
    public function products() {
        $this->checkAuth();
        
        $productModel = new Product();
        $products = $productModel->getAll();
        
        $title = "Gestion des produits - Admin";
        include __DIR__ . '/../views/admin/products.php';
    }
    
    public function productForm() {
        $this->checkAuth();
        
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        
        $product = null;
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $productModel = new Product();
            $product = $productModel->getById($id);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleProductForm($id);
        }
        
        $title = $id ? "Modifier le produit - Admin" : "Ajouter un produit - Admin";
        include __DIR__ . '/../views/admin/product_form.php';
    }
    
    private function handleProductForm($id = null) {
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $prix = filter_input(INPUT_POST, 'prix_location_jour', FILTER_VALIDATE_FLOAT);
        $quantite = filter_input(INPUT_POST, 'quantite_totale', FILTER_VALIDATE_INT);
        $categorie = filter_input(INPUT_POST, 'id_categorie', FILTER_VALIDATE_INT);
        $currentImage = filter_input(INPUT_POST, 'current_image', FILTER_SANITIZE_STRING);
        
        // Gestion de l'upload d'image
        $imageUrl = $currentImage; // Par défaut, garder l'image actuelle
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = realpath(__DIR__ . '/../../public/images/') . DIRECTORY_SEPARATOR;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            // Vérifications
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            
            if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imageUrl = $fileName;
                    
                    // Supprimer l'ancienne image si elle existe
                    if ($currentImage && file_exists($uploadDir . $currentImage)) {
                        unlink($uploadDir . $currentImage);
                    }
                }
            }
        }
        
        if ($nom && $prix && $quantite && $categorie) {
            $productModel = new Product();
            $data = [
                'nom' => $nom,
                'description' => $description,
                'prix_location_jour' => $prix,
                'quantite_totale' => $quantite,
                'id_categorie' => $categorie,
                'image_url' => $imageUrl
            ];
            
            if ($id) {
                $productModel->update($id, $data);
            } else {
                $productModel->create($data);
            }
            
            header('Location: /admin/products');
            exit;
        }
    }
    
    public function deleteProduct() {
        $this->checkAuth();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $productModel = new Product();
            $productModel->delete($id);
        }
        
        header('Location: /admin/products');
        exit;
    }
    
    public function reservations() {
        $this->checkAuth();
        
        $reservationModel = new Reservation();
        $reservations = $reservationModel->getAll();
        
        $title = "Gestion des réservations - Admin";
        include __DIR__ . '/../views/admin/reservations.php';
    }
    
    public function updateReservationStatus() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $statut = filter_input(INPUT_POST, 'statut', FILTER_SANITIZE_STRING);
            
            if ($id && $statut) {
                $reservationModel = new Reservation();
                $reservationModel->updateStatus($id, $statut);
            }
        }
        
        header('Location: /admin/reservations');
        exit;
    }
    
    public function reservationDetail() {
        $this->checkAuth();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/reservations');
            exit;
        }
        
        $reservationModel = new Reservation();
        $reservation = $reservationModel->getById($id);
        $details = $reservationModel->getDetails($id);
        
        if (!$reservation) {
            header('Location: /admin/reservations');
            exit;
        }
        
        $title = 'Détail réservation #' . $id . ' - Admin';
        include __DIR__ . '/../views/admin/reservation_detail.php';
    }
    
    public function categories() {
        $this->checkAuth();
        
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        
        $title = 'Gestion des catégories - Admin';
        include __DIR__ . '/../views/admin/categories.php';
    }
    
    public function addCategory() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            
            if ($nom) {
                $categoryModel = new Category();
                $categoryModel->create($nom);
            }
        }
        
        header('Location: /admin/categories');
        exit;
    }
    
    public function editCategory() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
            
            if ($id && $nom) {
                $categoryModel = new Category();
                $categoryModel->update($id, $nom);
            }
        }
        
        header('Location: /admin/categories');
        exit;
    }
    
    public function deleteCategory() {
        $this->checkAuth();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($id) {
            $categoryModel = new Category();
            $categoryModel->delete($id);
        }
        
        header('Location: /admin/categories');
        exit;
    }
    
    public function imageManager() {
        $this->checkAuth();
        
        $title = 'Gestionnaire d\'images - Admin';
        include __DIR__ . '/../views/admin/image_manager.php';
    }
    
    public function uploadImage() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $uploadDir = realpath(__DIR__ . '/../../public/images/') . DIRECTORY_SEPARATOR;
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            
            if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $_SESSION['success'] = 'Image uploadée avec succès !';
                } else {
                    $_SESSION['error'] = 'Erreur lors de l\'upload de l\'image.';
                }
            } else {
                $_SESSION['error'] = 'Format ou taille d\'image non valide.';
            }
        }
        
        header('Location: /admin/images');
        exit;
    }
    
    public function deleteImage() {
        $this->checkAuth();
        
        $imageName = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
        
        if ($imageName) {
            $imageDir = realpath(__DIR__ . '/../../public/images/');
            $imagePath = $imageDir . DIRECTORY_SEPARATOR . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
                $_SESSION['success'] = 'Image supprimée avec succès !';
            }
        }
        
        header('Location: /admin/images');
        exit;
    }
    
    public function productPreview() {
        $this->checkAuth();
        
        header('Content-Type: application/json');
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            echo json_encode(['error' => 'ID invalide']);
            exit;
        }
        
        $productModel = new Product();
        $product = $productModel->getById($id);
        
        if (!$product) {
            echo json_encode(['error' => 'Produit non trouvé']);
            exit;
        }
        
        echo json_encode($product);
        exit;
    }
}