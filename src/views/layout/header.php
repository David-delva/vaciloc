<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'VACILOC') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/categories.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/" style="font-family: var(--font-display); font-weight: 800; font-size: 1.5rem; letter-spacing: -0.02em;">
                <i class="fas fa-calendar-alt me-2"></i>VACILOC
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/catalog">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <a href="/cart" class="btn" style="background: rgba(15, 23, 42, 0.1); color: var(--gray-700); border: 2px solid var(--gray-200); font-weight: 600; position: relative;">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span class="d-none d-sm-inline">Panier</span>
                        <?php 
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                        if ($cartCount > 0): ?>
                            <span class="badge" style="position: absolute; top: -8px; right: -8px; background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); color: white; font-size: 0.7rem; padding: 0.25rem 0.5rem; border-radius: 50px; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </a>
                    
                    <a href="tel:+24177468028" class="d-none d-md-flex align-items-center text-decoration-none" style="color: var(--gray-700); font-weight: 500; padding: 0.5rem 1rem; background: rgba(15, 23, 42, 0.05); border-radius: 50px; transition: all 0.3s ease;">
                        <i class="fas fa-phone me-2" style="color: #10b981;"></i>
                        <span style="font-size: 0.9rem;">+241 77 46 80 28</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>