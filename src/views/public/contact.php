<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-5">Contactez-nous</h1>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="row">
        <!-- Formulaire de contact -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h4 class="mb-4">Envoyez-nous un message</h4>
                    
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Informations de contact -->
        <div class="col-lg-4">
            <div class="card shadow h-100">
                <div class="card-body p-4">
                    <h4 class="mb-4">Nos coordonnées</h4>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-phone text-primary me-2"></i>Téléphone</h6>
                        <p class="mb-0">+241 77 46 80 28</p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fab fa-whatsapp text-success me-2"></i>WhatsApp</h6>
                        <p class="mb-0">
                            <a href="https://wa.me/24177468028" class="text-decoration-none" target="_blank">
                                +241 77 46 80 28
                            </a>
                        </p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-map-marker-alt text-danger me-2"></i>Adresse</h6>
                        <p class="mb-0">
                            Owendo, carrefour SNI<br>
                            Libreville, Gabon
                        </p>
                    </div>
                    
                    <div class="mb-4">
                        <h6><i class="fas fa-clock text-info me-2"></i>Horaires</h6>
                        <p class="mb-0">
                            Lundi - Vendredi: 8h - 18h<br>
                            Samedi: 8h - 16h<br>
                            Dimanche: Sur rendez-vous
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Carte Google Maps -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body p-0">
                    <div class="ratio ratio-21x9">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.4567!2d9.4215!3d0.3842!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwMjMnMDMuMSJOIDnCsDI1JzE3LjQiRQ!5e0!3m2!1sfr!2sga!4v1234567890"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        Owendo, carrefour SNI - Libreville, Gabon
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>