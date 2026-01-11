<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <div style="width: 120px; height: 120px; margin: 0 auto 2rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 32px rgba(16, 185, 129, 0.3); animation: scaleIn 0.5s ease-out;">
                    <i class="fas fa-check fa-3x" style="color: white;"></i>
                </div>
                <h1 style="font-size: 2.5rem; font-weight: 800; color: #10b981; margin-bottom: 1rem;">Réservation envoyée !</h1>
                <p style="font-size: 1.25rem; color: #6b7280;">Votre demande de réservation a été envoyée avec succès.</p>
            </div>
            
            <div class="card" style="border: none; border-radius: 24px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); overflow: hidden; margin-bottom: 2rem;">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border: none;">
                    <h4 style="margin: 0; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-receipt"></i>
                        Récapitulatif de votre demande
                    </h4>
                </div>
                <div class="card-body" style="padding: 2rem;">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div style="background: #f9fafb; padding: 1.5rem; border-radius: 16px; height: 100%;">
                                <h6 style="font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-user-circle" style="color: #667eea;"></i>
                                    Informations client
                                </h6>
                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                    <div>
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Nom complet</div>
                                        <div style="font-weight: 600; color: #1f2937;"><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Email</div>
                                        <div style="font-weight: 600; color: #1f2937;"><?= htmlspecialchars($reservation['email']) ?></div>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Téléphone</div>
                                        <div style="font-weight: 600; color: #1f2937;">
                                            <i class="fas fa-phone me-1" style="color: #10b981;"></i>
                                            <?= htmlspecialchars($reservation['telephone']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); padding: 1.5rem; border-radius: 16px; height: 100%; border-left: 4px solid #10b981;">
                                <h6 style="font-weight: 700; color: #065f46; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-calendar-check"></i>
                                    Détails de la réservation
                                </h6>
                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                    <div>
                                        <div style="font-size: 0.75rem; color: #047857; margin-bottom: 0.25rem;">Numéro de réservation</div>
                                        <div style="font-weight: 700; color: #065f46; font-size: 1.25rem;">#<?= $reservation['id'] ?></div>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; color: #047857; margin-bottom: 0.25rem;">Période</div>
                                        <div style="font-weight: 600; color: #065f46;">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?= date('d/m/Y', strtotime($reservation['date_debut'])) ?> → <?= date('d/m/Y', strtotime($reservation['date_fin'])) ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; color: #047857; margin-bottom: 0.25rem;">Montant total</div>
                                        <div style="font-weight: 800; color: #10b981; font-size: 1.75rem;"><?= number_format($reservation['total'], 0, ',', ' ') ?> <span style="font-size: 1rem;">FCFA</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr style="border-color: #e5e7eb; margin: 2rem 0;">
                    
                    <div style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); padding: 1.5rem; border-radius: 16px; border-left: 4px solid #3b82f6;">
                        <h6 style="font-weight: 700; color: #1e40af; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-info-circle"></i>
                            Prochaines étapes
                        </h6>
                        <ul style="margin: 0; padding-left: 1.5rem; color: #1e3a8a;">
                            <li style="margin-bottom: 0.5rem;">Nous examinerons votre demande dans les plus brefs délais</li>
                            <li style="margin-bottom: 0.5rem;">Vous recevrez une confirmation par email ou téléphone</li>
                            <li>Le paiement se fera à la livraison ou au retrait</li>
                        </ul>
                    </div>
                    
                    <div class="text-center mt-4" style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="/" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.75rem 2rem; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                        <a href="/catalog" class="btn" style="background: white; color: #667eea; border: 2px solid #667eea; padding: 0.75rem 2rem; border-radius: 12px; font-weight: 600;">
                            <i class="fas fa-search me-2"></i>Continuer mes achats
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="background: white; padding: 1.5rem; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <p style="margin: 0; color: #6b7280;">
                    <i class="fas fa-question-circle me-2" style="color: #667eea;"></i>
                    Une question ? Contactez-nous au 
                    <a href="tel:+24177468028" style="color: #10b981; text-decoration: none; font-weight: 600;">+241 77 46 80 28</a>
                    ou sur 
                    <a href="https://wa.me/24177468028" target="_blank" style="color: #10b981; text-decoration: none; font-weight: 600;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
</style>

<?php include __DIR__ . '/../layout/footer.php'; ?>