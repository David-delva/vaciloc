<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Administration') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        body {
            background: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
        }
        .sidebar .admin-header {
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }
        .sidebar .admin-avatar {
            width: 70px;
            height: 70px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.7);
            border-radius: 10px;
            margin: 0.25rem 0.75rem;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            color: white;
            background: var(--primary-gradient);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        .main-header {
            background: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <button class="btn btn-outline-light d-md-none mb-3 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <i class="fas fa-times"></i> Fermer
                    </button>
                    
                    <div class="admin-header">
                        <div class="admin-avatar">
                            <i class="fas fa-user-shield fa-2x" style="color: white;"></i>
                        </div>
                        <h5 style="color: white; font-weight: 700; margin-bottom: 0.25rem;">Administration</h5>
                        <small style="color: rgba(255,255,255,0.6); font-size: 0.875rem;">
                            <i class="fas fa-circle" style="color: #10b981; font-size: 0.5rem; margin-right: 0.25rem;"></i>
                            <?= htmlspecialchars($_SESSION['admin_username']) ?>
                        </small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/categories">
                                <i class="fas fa-tags me-2"></i>Catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/products">
                                <i class="fas fa-box me-2"></i>Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/images">
                                <i class="fas fa-images me-2"></i>Images
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/reservations">
                                <i class="fas fa-calendar-check me-2"></i>Réservations
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                            <a class="nav-link" href="/" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Voir le site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout" style="color: #fca5a5;">
                                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="main-header">
                    <div class="d-flex justify-content-between align-items-center px-3">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-primary d-md-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" style="border-radius: 10px;">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <h1 class="h3 mb-0" style="font-weight: 700; color: #1f2937;"><?= $pageTitle ?? 'Administration' ?></h1>
                                <small style="color: #6b7280;">
                                    <i class="fas fa-clock me-1"></i>
                                    <?= date('d/m/Y H:i') ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; border-left: 4px solid #10b981;">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['success']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; border-left: 4px solid #ef4444;">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['error']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                
                <!-- Content will be inserted here -->
                <?php if (isset($content)) echo $content; ?>