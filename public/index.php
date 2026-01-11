<?php
/**
 * Point d'entrée principal de l'application
 * Toutes les requêtes sont redirigées vers ce fichier
 */

// Affichage des erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Démarrage de la session
session_start();

// Chargement de la configuration
require_once __DIR__ . '/../config/database.php';

// Chargement des classes utilitaires
require_once __DIR__ . '/../lib/Database.php';
require_once __DIR__ . '/../lib/Router.php';

// Initialisation du routeur
$router = new Router();

// Routes publiques
$router->addRoute('GET', '/', 'HomeController', 'index');
$router->addRoute('GET', '/catalog', 'ProductController', 'catalog');
$router->addRoute('GET', '/product', 'ProductController', 'detail');
$router->addRoute('POST', '/add-to-cart', 'ProductController', 'addToCart');
$router->addRoute('GET', '/cart', 'ProductController', 'cart');
$router->addRoute('GET', '/remove-from-cart', 'ProductController', 'removeFromCart');
$router->addRoute('POST', '/create-reservation', 'ReservationController', 'create');
$router->addRoute('GET', '/reservation-success', 'ReservationController', 'success');
$router->addRoute('GET', '/contact', 'HomeController', 'contact');
$router->addRoute('POST', '/contact', 'HomeController', 'contact');

// Routes d'administration
$router->addRoute('GET', '/admin', 'AdminController', 'login');
$router->addRoute('POST', '/admin', 'AdminController', 'login');
$router->addRoute('GET', '/admin/logout', 'AdminController', 'logout');
$router->addRoute('GET', '/admin/dashboard', 'AdminController', 'dashboard');
$router->addRoute('GET', '/admin/products', 'AdminController', 'products');
$router->addRoute('GET', '/admin/product-form', 'AdminController', 'productForm');
$router->addRoute('POST', '/admin/product-form', 'AdminController', 'productForm');
$router->addRoute('GET', '/admin/delete-product', 'AdminController', 'deleteProduct');
$router->addRoute('GET', '/admin/reservations', 'AdminController', 'reservations');
$router->addRoute('GET', '/admin/reservation-detail', 'AdminController', 'reservationDetail');
$router->addRoute('POST', '/admin/update-reservation-status', 'AdminController', 'updateReservationStatus');
$router->addRoute('GET', '/admin/categories', 'AdminController', 'categories');
$router->addRoute('POST', '/admin/add-category', 'AdminController', 'addCategory');
$router->addRoute('POST', '/admin/edit-category', 'AdminController', 'editCategory');
$router->addRoute('GET', '/admin/delete-category', 'AdminController', 'deleteCategory');
$router->addRoute('GET', '/admin/images', 'AdminController', 'imageManager');
$router->addRoute('POST', '/admin/upload-image', 'AdminController', 'uploadImage');
$router->addRoute('GET', '/admin/delete-image', 'AdminController', 'deleteImage');
$router->addRoute('GET', '/admin/product-preview', 'AdminController', 'productPreview');

// Gestion des erreurs
try {
    // Dispatch de la route
    $router->dispatch();
} catch (Exception $e) {
    // Log de l'erreur (en production, utilisez un système de log approprié)
    error_log("Erreur application: " . $e->getMessage());
    
    // Affichage d'une page d'erreur générique
    http_response_code(500);
    include __DIR__ . '/../src/views/public/500.php';
}