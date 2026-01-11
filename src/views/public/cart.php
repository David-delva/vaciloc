<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">
            <i class="fas fa-shopping-cart me-2" style="color: #667eea;"></i>Mon Panier
        </h1>
        <p style="color: #6b7280; font-size: 1.1rem;">Finalisez votre réservation de matériel événementiel</p>
    </div>
    
    <?php if (empty($cart)): ?>
        <div style="text-align: center; padding: 5rem 2rem; background: white; border-radius: 24px; box-shadow: 0 8px 32px rgba(0,0,0,0.08);">
            <div style="width: 120px; height: 120px; margin: 0 auto 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                <i class="fas fa-shopping-cart fa-3x" style="color: white;"></i>
            </div>
            <h4 style="font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Votre panier est vide</h4>
            <p style="color: #6b7280; margin-bottom: 2rem;">Ajoutez des produits à votre panier pour commencer votre réservation.</p>
            <a href="/catalog" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 1rem 2.5rem; border-radius: 50px; font-weight: 700; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);">
                <i class="fas fa-search me-2"></i>Parcourir le catalogue
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <!-- Articles du panier -->
            <div class="col-lg-8">
                <?php 
                $totalGeneral = 0;
                foreach ($cart as $index => $item): 
                    $dateDebut = new DateTime($item['date_debut']);
                    $dateFin = new DateTime($item['date_fin']);
                    $jours = $dateDebut->diff($dateFin)->days + 1;
                    $sousTotal = $item['prix_location_jour'] * $item['quantity'] * $jours;
                    $totalGeneral += $sousTotal;
                ?>
                    <div class="card mb-3" style="border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden;">
                        <div class="card-body" style="padding: 1.5rem;">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="/images/<?= htmlspecialchars($item['image_url']) ?>" 
                                         class="img-fluid" 
                                         alt="<?= htmlspecialchars($item['nom']) ?>"
                                         style="border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                </div>
                                <div class="col-md-4">
                                    <h5 style="font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;"><?= htmlspecialchars($item['nom']) ?></h5>
                                    <div style="color: #6b7280; font-size: 0.875rem;">
                                        <div style="margin-bottom: 0.25rem;">
                                            <i class="fas fa-calendar me-1" style="color: #667eea;"></i>
                                            <?= $dateDebut->format('d/m/Y') ?> → <?= $dateFin->format('d/m/Y') ?>
                                        </div>
                                        <div>
                                            <i class="fas fa-clock me-1" style="color: #10b981;"></i>
                                            <?= $jours ?> jour<?= $jours > 1 ? 's' : '' ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div style="background: #f3f4f6; padding: 0.75rem; border-radius: 12px;">
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Quantité</div>
                                        <div style="font-size: 1.5rem; font-weight: 700; color: #1f2937;"><?= $item['quantity'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Prix/jour</div>
                                    <div style="font-weight: 600; color: #1f2937;"><?= number_format($item['prix_location_jour'], 0, ',', ' ') ?> FCFA</div>
                                </div>
                                <div class="col-md-2 text-end">
                                    <div style="margin-bottom: 1rem;">
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-bottom: 0.25rem;">Sous-total</div>
                                        <div style="font-size: 1.25rem; font-weight: 800; color: #10b981;"><?= number_format($sousTotal, 0, ',', ' ') ?> FCFA</div>
                                    </div>
                                    <a href="/remove-from-cart?index=<?= $index ?>" 
                                       class="btn btn-sm"
                                       style="background: #fee2e2; color: #991b1b; border: none; padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600;"
                                       onclick="return confirm('Supprimer cet article ?')">
                                        <i class="fas fa-trash me-1"></i>Retirer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Récapitulatif et formulaire -->
            <div class="col-lg-4">
                <div class="card" style="border: none; border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); position: sticky; top: 100px;">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border: none; border-radius: 20px 20px 0 0;">
                        <h5 style="margin: 0; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-receipt"></i>
                            Récapitulatif
                        </h5>
                    </div>
                    <div class="card-body" style="padding: 2rem;">
                        <div style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; border-left: 4px solid #10b981;">
                            <div style="font-size: 0.875rem; color: #065f46; font-weight: 600; margin-bottom: 0.5rem;">Total à payer</div>
                            <div style="font-size: 2.5rem; font-weight: 800; color: #10b981; line-height: 1;"><?= number_format($totalGeneral, 0, ',', ' ') ?> <span style="font-size: 1rem;">FCFA</span></div>
                        </div>
                        
                        <hr style="border-color: #e5e7eb; margin: 1.5rem 0;">
                        
                        <!-- Formulaire de finalisation -->
                        <form action="/create-reservation" method="POST">
                            <h6 style="font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-user-circle" style="color: #667eea;"></i>
                                Vos informations
                            </h6>
                            
                            <div class="mb-3">
                                <label for="nom" class="form-label" style="font-weight: 600; color: #374151; font-size: 0.875rem;">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required
                                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;">
                            </div>
                            
                            <div class="mb-3">
                                <label for="prenom" class="form-label" style="font-weight: 600; color: #374151; font-size: 0.875rem;">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required
                                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;">
                            </div>
                            
                            <div class="mb-3">
                                <label for="quartier" class="form-label" style="font-weight: 600; color: #374151; font-size: 0.875rem;">Quartier *</label>
                                <input type="text" class="form-control" id="quartier" name="quartier" placeholder="Ex: Owendo, Akanda..." required
                                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;">
                            </div>
                            
                            <div class="mb-3">
                                <label for="telephone" class="form-label" style="font-weight: 600; color: #374151; font-size: 0.875rem;">Téléphone *</label>
                                <input type="tel" class="form-control" id="telephone" name="telephone" required
                                       style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;">
                            </div>
                            
                            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 1rem; border-radius: 12px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 4px 16px rgba(16, 185, 129, 0.4);">
                                <i class="fas fa-check-circle me-2"></i>Finaliser la demande
                            </button>
                        </form>
                        
                        <div style="margin-top: 1.5rem; padding: 1rem; background: #f9fafb; border-radius: 12px; text-align: center;">
                            <small style="color: #6b7280; font-size: 0.875rem;">
                                <i class="fas fa-info-circle me-1" style="color: #667eea;"></i>
                                Nous vous contacterons pour confirmer votre réservation
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>