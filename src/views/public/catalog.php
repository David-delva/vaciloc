<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container py-5">
    <div class="row">
        <!-- Filtres par catégorie -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar" style="background: white; border-radius: 20px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); position: sticky; top: 100px;">
                <div class="filter-header" style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-sliders-h" style="color: white; font-size: 1.25rem;"></i>
                        </div>
                        <h5 style="margin: 0; font-weight: 700; color: #1f2937;">Filtres</h5>
                    </div>
                </div>
                <div class="filter-body">
                    <a href="/catalog" class="filter-item <?= !$selectedCategory ? 'active' : '' ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; border-radius: 12px; text-decoration: none; margin-bottom: 0.5rem; transition: all 0.3s ease; <?= !$selectedCategory ? 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;' : 'background: #f9fafb; color: #6b7280;' ?>" onmouseover="if(!this.classList.contains('active')) this.style.background='#f3f4f6'" onmouseout="if(!this.classList.contains('active')) this.style.background='#f9fafb'">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-th-large"></i>
                            <span style="font-weight: 600;">Toutes les catégories</span>
                        </div>
                        <?= !$selectedCategory ? '<i class="fas fa-check"></i>' : '' ?>
                    </a>
                    <?php foreach ($categories as $category): ?>
                        <a href="/catalog?category=<?= $category['id'] ?>" 
                           class="filter-item <?= $selectedCategory && $selectedCategory['id'] == $category['id'] ? 'active' : '' ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; border-radius: 12px; text-decoration: none; margin-bottom: 0.5rem; transition: all 0.3s ease; <?= $selectedCategory && $selectedCategory['id'] == $category['id'] ? 'background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;' : 'background: #f9fafb; color: #6b7280;' ?>" onmouseover="if(!this.classList.contains('active')) this.style.background='#f3f4f6'" onmouseout="if(!this.classList.contains('active')) this.style.background='#f9fafb'">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <i class="fas fa-tag"></i>
                                <span style="font-weight: 600;"><?= htmlspecialchars($category['nom']) ?></span>
                            </div>
                            <?= $selectedCategory && $selectedCategory['id'] == $category['id'] ? '<i class="fas fa-check"></i>' : '' ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Liste des produits -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4" style="background: white; padding: 1.5rem; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div>
                    <h2 style="margin: 0; font-weight: 700; color: #1f2937;">
                        <?= $selectedCategory ? htmlspecialchars($selectedCategory['nom']) : 'Tous nos produits' ?>
                    </h2>
                    <p style="margin: 0.25rem 0 0 0; color: #6b7280;"><?= count($products) ?> produit(s) disponible(s)</p>
                </div>
            </div>
            
            <?php if (empty($products)): ?>
                <div style="text-align: center; padding: 5rem 2rem; background: white; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    <div style="width: 100px; height: 100px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                        <i class="fas fa-box-open fa-3x" style="color: white;"></i>
                    </div>
                    <h4 style="font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Aucun produit trouvé</h4>
                    <p style="color: #6b7280;">Aucun produit n'est disponible dans cette catégorie pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-6 col-xl-4">
                            <div class="card h-100" style="border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'">
                                <div style="position: relative; overflow: hidden;">
                                    <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                                         class="card-img-top" 
                                         alt="<?= htmlspecialchars($product['nom']) ?>"
                                         style="height: 220px; object-fit: cover; transition: transform 0.3s ease;"
                                         onmouseover="this.style.transform='scale(1.1)'"
                                         onmouseout="this.style.transform='scale(1)'">
                                    <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 0.4rem 0.8rem; border-radius: 50px; font-weight: 700; font-size: 0.75rem; color: #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Stock: <?= $product['quantite_totale'] ?>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                                    <div style="margin-bottom: 0.75rem;">
                                        <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                            <?= htmlspecialchars($product['categorie_nom']) ?>
                                        </span>
                                    </div>
                                    <h5 class="card-title" style="font-weight: 700; color: #1f2937; margin-bottom: 0.75rem;"><?= htmlspecialchars($product['nom']) ?></h5>
                                    <p class="card-text flex-grow-1" style="color: #6b7280; font-size: 0.95rem; line-height: 1.6;">
                                        <?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...
                                    </p>
                                    <div class="mt-auto">
                                        <div style="margin-bottom: 1rem; padding-top: 1rem; border-top: 1px solid #f3f4f6;">
                                            <div style="font-size: 1.75rem; font-weight: 800; color: #10b981;">
                                                <?= number_format($product['prix_location_jour'], 0, ',', ' ') ?> 
                                                <span style="font-size: 0.875rem; color: #6b7280; font-weight: 500;">FCFA</span>
                                            </div>
                                            <div style="font-size: 0.75rem; color: #9ca3af;">par jour</div>
                                        </div>
                                        <a href="/product?id=<?= $product['id'] ?>" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.75rem; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                            <i class="fas fa-eye me-2"></i>Voir détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>