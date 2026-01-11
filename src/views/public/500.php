<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <div class="py-5">
                <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
                <h1 class="display-1 fw-bold text-danger">500</h1>
                <h2 class="mb-4">Erreur interne du serveur</h2>
                <p class="lead text-muted mb-4">
                    Une erreur inattendue s'est produite. Nos équipes techniques ont été notifiées et travaillent à résoudre le problème.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="/" class="btn btn-primary btn-lg me-md-2">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                    <a href="/contact" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>