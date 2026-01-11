<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <nav aria-label="breadcrumb" style="margin-bottom: 2rem;">
        <ol class="breadcrumb" style="background: white; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <li class="breadcrumb-item"><a href="/" style="color: #667eea; text-decoration: none; font-weight: 500;"><i class="fas fa-home me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="/catalog" style="color: #667eea; text-decoration: none; font-weight: 500;">Catalogue</a></li>
            <li class="breadcrumb-item active" style="color: #6b7280; font-weight: 600;"><?= htmlspecialchars($product['nom']) ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Images du produit -->
        <div class="col-lg-6 mb-4">
            <div class="card" style="border: none; border-radius: 24px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.12); position: sticky; top: 100px;">
                <div style="position: relative;">
                    <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($product['nom']) ?>"
                         style="height: 500px; object-fit: cover;">
                    <div style="position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 0.75rem 1.25rem; border-radius: 50px; font-weight: 700; color: #10b981; box-shadow: 0 4px 16px rgba(0,0,0,0.15);">
                        <i class="fas fa-check-circle me-2"></i>
                        En stock
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Informations du produit -->
        <div class="col-lg-6">
            <div style="margin-bottom: 1.5rem;">
                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">
                    <?= htmlspecialchars($product['categorie_nom']) ?>
                </span>
            </div>
            
            <h1 style="font-size: 2.5rem; font-weight: 800; color: #1f2937; margin-bottom: 1.5rem; line-height: 1.2;"><?= htmlspecialchars($product['nom']) ?></h1>
            
            <div style="background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; border-left: 4px solid #10b981;">
                <div style="font-size: 0.875rem; color: #065f46; font-weight: 600; margin-bottom: 0.5rem;">Prix de location</div>
                <div style="font-size: 3rem; font-weight: 800; color: #10b981; line-height: 1;">
                    <?= number_format($product['prix_location_jour'], 0, ',', ' ') ?> 
                    <span style="font-size: 1.25rem; color: #059669; font-weight: 600;">FCFA</span>
                </div>
                <div style="font-size: 0.875rem; color: #047857; margin-top: 0.5rem;">par jour de location</div>
            </div>
            
            <div style="background: white; padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <h5 style="font-weight: 700; color: #1f2937; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-align-left" style="color: #667eea;"></i>
                    Description
                </h5>
                <p style="color: #6b7280; line-height: 1.8; margin: 0;"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
            
            <div style="background: white; padding: 1.5rem; border-radius: 16px; margin-bottom: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <h5 style="font-weight: 700; color: #1f2937; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-boxes" style="color: #10b981;"></i>
                    Disponibilité
                </h5>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle" style="color: #10b981; font-size: 1.75rem;"></i>
                    </div>
                    <div>
                        <div style="font-size: 1.5rem; font-weight: 700; color: #10b981;"><?= $product['quantite_totale'] ?> unité(s)</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">disponibles en stock</div>
                    </div>
                </div>
            </div>
            
            <!-- Formulaire de réservation -->
            <div class="card" style="border: none; box-shadow: var(--shadow-xl); border-radius: var(--radius-xl); overflow: hidden;">
                <div class="card-header" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; padding: var(--spacing-xl); border: none;">
                    <h5 class="mb-0" style="font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-calendar-plus"></i>
                        Réserver ce produit
                    </h5>
                </div>
                <form action="/add-to-cart" method="POST" class="card-body" style="padding: var(--spacing-xl);">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    
                    <div class="row g-4">
                        <div class="col-12">
                            <label for="quantity" class="form-label" style="font-weight: 600; color: var(--gray-700); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                <i class="fas fa-boxes me-2" style="color: var(--primary);"></i>Quantité
                            </label>
                            <div class="input-group" style="box-shadow: var(--shadow-sm);">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('quantity').stepDown(); document.getElementById('quantity').dispatchEvent(new Event('input'));" style="border: 2px solid var(--gray-200); color: var(--gray-700);">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center" id="quantity" name="quantity" 
                                       min="1" max="<?= $product['quantite_totale'] ?>" value="1" required
                                       style="border: 2px solid var(--gray-200); border-left: none; border-right: none; font-weight: 700; font-size: 1.125rem;">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('quantity').stepUp(); document.getElementById('quantity').dispatchEvent(new Event('input'));" style="border: 2px solid var(--gray-200); color: var(--gray-700);">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <small style="color: var(--gray-500); margin-top: 0.5rem; display: block;">
                                <i class="fas fa-info-circle me-1"></i>Maximum <?= $product['quantite_totale'] ?> unité(s) disponible(s)
                            </small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="date_debut" class="form-label" style="font-weight: 600; color: var(--gray-700); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                <i class="fas fa-calendar-day me-2" style="color: var(--success);"></i>Date de début
                            </label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" 
                                   min="<?= date('Y-m-d') ?>" required
                                   style="border: 2px solid var(--gray-200); padding: var(--spacing-md) var(--spacing-lg); box-shadow: var(--shadow-sm);">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="date_fin" class="form-label" style="font-weight: 600; color: var(--gray-700); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                <i class="fas fa-calendar-check me-2" style="color: var(--danger);"></i>Date de fin
                            </label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" 
                                   min="<?= date('Y-m-d') ?>" required
                                   style="border: 2px solid var(--gray-200); padding: var(--spacing-md) var(--spacing-lg); box-shadow: var(--shadow-sm);">
                        </div>
                        
                        <div class="col-12">
                            <div id="total-preview" style="display: none; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%); border-left: 4px solid var(--success); padding: var(--spacing-lg); border-radius: var(--radius-lg);">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-size: 0.875rem; color: var(--gray-600); font-weight: 600; margin-bottom: 0.25rem;">Coût total estimé</div>
                                        <div style="font-size: 2rem; font-weight: 800; color: var(--success); font-family: var(--font-display); line-height: 1;">
                                            <span id="total-amount">0</span> <span style="font-size: 1rem; font-weight: 600;">FCFA</span>
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 0.875rem; color: var(--gray-600);">Durée</div>
                                        <div style="font-size: 1.25rem; font-weight: 700; color: var(--gray-800);">
                                            <span id="duration-days">0</span> jour(s)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100" style="padding: var(--spacing-lg); font-weight: 700; font-size: 1.125rem; box-shadow: var(--shadow-lg);">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                        
                        <div class="col-12">
                            <div style="display: flex; gap: 1rem; padding: var(--spacing-md); background: var(--gray-50); border-radius: var(--radius-md);">
                                <div style="flex: 1; text-align: center;">
                                    <i class="fas fa-shield-alt" style="color: var(--success); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <div style="font-size: 0.75rem; color: var(--gray-600); font-weight: 600;">Paiement sécurisé</div>
                                </div>
                                <div style="flex: 1; text-align: center;">
                                    <i class="fas fa-truck" style="color: var(--primary); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <div style="font-size: 0.75rem; color: var(--gray-600); font-weight: 600;">Livraison rapide</div>
                                </div>
                                <div style="flex: 1; text-align: center;">
                                    <i class="fas fa-headset" style="color: var(--info); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                                    <div style="font-size: 0.75rem; color: var(--gray-600); font-weight: 600;">Support 24/7</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const dateDebutInput = document.getElementById('date_debut');
    const dateFinInput = document.getElementById('date_fin');
    const totalPreview = document.getElementById('total-preview');
    const totalAmount = document.getElementById('total-amount');
    const prixJour = <?= $product['prix_location_jour'] ?>;
    
    function calculateTotal() {
        const quantity = parseInt(quantityInput.value) || 0;
        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);
        
        if (quantity > 0 && dateDebut && dateFin && dateFin >= dateDebut) {
            const jours = Math.ceil((dateFin - dateDebut) / (1000 * 60 * 60 * 24)) + 1;
            const total = quantity * prixJour * jours;
            
            totalAmount.textContent = total.toLocaleString('fr-FR');
            document.getElementById('duration-days').textContent = jours;
            totalPreview.style.display = 'block';
        } else {
            totalPreview.style.display = 'none';
        }
    }
    
    quantityInput.addEventListener('input', calculateTotal);
    dateDebutInput.addEventListener('change', calculateTotal);
    dateFinInput.addEventListener('change', calculateTotal);
    
    // Synchroniser les dates
    dateDebutInput.addEventListener('change', function() {
        dateFinInput.min = this.value;
        if (dateFinInput.value < this.value) {
            dateFinInput.value = this.value;
        }
    });
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>