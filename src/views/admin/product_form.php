<?php 
$pageTitle = $product ? 'Modifier le produit' : 'Ajouter un produit';
ob_start(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1" style="font-weight: 700; color: #1f2937;">
            <i class="fas fa-<?= $product ? 'edit' : 'plus-circle' ?> me-2" style="color: #667eea;"></i>
            <?= $pageTitle ?>
        </h2>
        <p class="text-muted mb-0"><?= $product ? 'Modifiez les informations du produit' : 'Ajoutez un nouveau produit au catalogue' ?></p>
    </div>
    <a href="/admin/products" class="btn btn-outline-secondary" style="border-radius: 10px; font-weight: 500;">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>

<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px;">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border: none; border-radius: 16px 16px 0 0;">
                <h5 class="mb-0" style="font-weight: 600;">
                    <i class="fas fa-info-circle me-2"></i>
                    Informations du produit
                </h5>
            </div>
            <div class="card-body" style="padding: 2rem;">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label for="nom" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-tag me-1" style="color: #667eea;"></i>
                                Nom du produit *
                            </label>
                            <input type="text" class="form-control" id="nom" name="nom" 
                                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;"
                                   value="<?= $product ? htmlspecialchars($product['nom']) : '' ?>" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="id_categorie" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-folder me-1" style="color: #667eea;"></i>
                                Catégorie *
                            </label>
                            <select class="form-select" id="id_categorie" name="id_categorie" 
                                    style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;"
                                    required>
                                <option value="">Choisir...</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" 
                                            <?= $product && $product['id_categorie'] == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['nom']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="description" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-align-left me-1" style="color: #667eea;"></i>
                                Description
                            </label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                      style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;"><?= $product ? htmlspecialchars($product['description']) : '' ?></textarea>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="prix_location_jour" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-money-bill-wave me-1" style="color: #10b981;"></i>
                                Prix par jour (FCFA) *
                            </label>
                            <input type="number" class="form-control" id="prix_location_jour" name="prix_location_jour" 
                                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;"
                                   step="0.01" min="0" 
                                   value="<?= $product ? $product['prix_location_jour'] : '' ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="quantite_totale" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-boxes me-1" style="color: #f59e0b;"></i>
                                Quantité en stock *
                            </label>
                            <input type="number" class="form-control" id="quantite_totale" name="quantite_totale" 
                                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;"
                                   min="0" 
                                   value="<?= $product ? $product['quantite_totale'] : '' ?>" required>
                        </div>
                        
                        <div class="col-12">
                            <label for="image" class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                <i class="fas fa-image me-1" style="color: #8b5cf6;"></i>
                                Image du produit
                            </label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                   style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.75rem;">
                            <input type="hidden" name="current_image" value="<?= $product ? htmlspecialchars($product['image_url']) : '' ?>">
                            <div class="form-text" style="color: #6b7280; margin-top: 0.5rem;">
                                <i class="fas fa-info-circle me-1"></i>
                                Formats acceptés : JPG, PNG, GIF (max 5MB)
                            </div>
                        </div>
                        
                        <?php if ($product && $product['image_url']): ?>
                            <div class="col-12">
                                <label class="form-label" style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                                    <i class="fas fa-eye me-1" style="color: #667eea;"></i>
                                    Aperçu actuel
                                </label>
                                <div style="background: #f9fafb; padding: 1rem; border-radius: 10px; border: 2px dashed #e5e7eb;">
                                    <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                                         alt="<?= htmlspecialchars($product['nom']) ?>"
                                         style="max-width: 200px; max-height: 200px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="col-12">
                            <hr style="border-color: #e5e7eb; margin: 1rem 0;">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 0.75rem 2rem; border-radius: 10px; font-weight: 600;">
                                    <i class="fas fa-save me-2"></i>
                                    <?= $product ? 'Mettre à jour' : 'Créer le produit' ?>
                                </button>
                                <a href="/admin/products" class="btn btn-outline-secondary" style="padding: 0.75rem 2rem; border-radius: 10px; font-weight: 500;">
                                    <i class="fas fa-times me-2"></i>
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-xl-4 mt-4 mt-xl-0">
        <div class="card" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px;">
            <div class="card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 1.25rem; border: none; border-radius: 16px 16px 0 0;">
                <h6 class="mb-0" style="font-weight: 600;">
                    <i class="fas fa-lightbulb me-2"></i>
                    Aide & Conseils
                </h6>
            </div>
            <div class="card-body" style="padding: 1.5rem;">
                <div class="mb-4">
                    <div style="background: #dbeafe; padding: 1rem; border-radius: 10px; margin-bottom: 0.75rem;">
                        <h6 style="color: #1e40af; font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-image me-1"></i>
                            Images
                        </h6>
                        <p class="small mb-0" style="color: #1e3a8a;">
                            Téléchargez une image claire du produit. Elle sera automatiquement optimisée pour le site.
                        </p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <div style="background: #d1fae5; padding: 1rem; border-radius: 10px; margin-bottom: 0.75rem;">
                        <h6 style="color: #065f46; font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-money-bill-wave me-1"></i>
                            Prix
                        </h6>
                        <p class="small mb-0" style="color: #064e3b;">
                            Le prix est calculé par jour. Le coût total sera automatiquement calculé selon la durée.
                        </p>
                    </div>
                </div>
                
                <div>
                    <div style="background: #fef3c7; padding: 1rem; border-radius: 10px;">
                        <h6 style="color: #92400e; font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-boxes me-1"></i>
                            Stock
                        </h6>
                        <p class="small mb-0" style="color: #78350f;">
                            La disponibilité est gérée automatiquement selon les réservations actives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>