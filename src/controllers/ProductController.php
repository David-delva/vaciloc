<?php
/**
 * Contrôleur Product - Gestion des produits côté public
 */

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class ProductController {
    
    public function catalog() {
        $productModel = new Product();
        $categoryModel = new Category();
        
        $categoryId = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
        
        if ($categoryId) {
            $products = $productModel->getByCategory($categoryId);
            $selectedCategory = $categoryModel->getById($categoryId);
        } else {
            $products = $productModel->getAll();
            $selectedCategory = null;
        }
        
        $categories = $categoryModel->getAll();
        $title = "Catalogue - Location de matériel événementiel";
        
        include __DIR__ . '/../views/public/catalog.php';
    }
    
    public function detail() {
        $productModel = new Product();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            header('Location: /catalog');
            exit;
        }
        
        $product = $productModel->getById($id);
        
        if (!$product) {
            header('Location: /catalog');
            exit;
        }
        
        $title = $product['nom'] . " - Location de matériel événementiel";
        
        include __DIR__ . '/../views/public/product_detail.php';
    }
    
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /catalog');
            exit;
        }
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $productId = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
        $dateDebut = filter_input(INPUT_POST, 'date_debut', FILTER_SANITIZE_STRING);
        $dateFin = filter_input(INPUT_POST, 'date_fin', FILTER_SANITIZE_STRING);
        
        if ($productId && $quantity && $dateDebut && $dateFin) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $productModel = new Product();
            $product = $productModel->getById($productId);
            
            if ($product) {
                $_SESSION['cart'][] = [
                    'product_id' => $productId,
                    'nom' => $product['nom'],
                    'prix_location_jour' => $product['prix_location_jour'],
                    'quantity' => $quantity,
                    'date_debut' => $dateDebut,
                    'date_fin' => $dateFin,
                    'image_url' => $product['image_url']
                ];
            }
        }
        
        header('Location: /cart');
        exit;
    }
    
    public function cart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $cart = $_SESSION['cart'] ?? [];
        $title = "Panier - Location de matériel événementiel";
        
        include __DIR__ . '/../views/public/cart.php';
    }
    
    public function removeFromCart() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $index = filter_input(INPUT_GET, 'index', FILTER_VALIDATE_INT);
        
        if ($index !== null && isset($_SESSION['cart'][$index])) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Réindexer
        }
        
        header('Location: /cart');
        exit;
    }
}