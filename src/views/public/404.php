<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="py-5">
                <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                <h1 class="display-1 fw-bold text-primary">404</h1>
                <h2 class="mb-4">Page non trouvée</h2>
                <p class="lead text-muted mb-4">
                    Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="/" class="btn btn-primary btn-lg me-md-2">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="/catalog" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-search me-2"></i>Voir le catalogue
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>