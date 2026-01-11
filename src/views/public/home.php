<?php include __DIR__ . '/../layout/header.php'; ?>

<!-- Hero Section Premium -->
<section class="hero-section text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);">
    <div class="container hero-content">
        <div class="row align-items-center" style="min-height: 90vh;">
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="badge" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.875rem; font-weight: 600;">
                        <i class="fas fa-star me-2"></i>Location Premium à Libreville
                    </span>
                </div>
                <h1 class="hero-title mb-4">
                    Votre événement,<br>
                    <span class="text-gradient" style="background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.8) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">notre matériel</span>
                </h1>
                <p class="hero-subtitle mb-4" style="font-size: 1.25rem; line-height: 1.8; color: rgba(255,255,255,0.9);">
                    Location de matériel événementiel de qualité. Chaises, tables, vaisselle et bien plus pour faire de votre événement un succès inoubliable.
                </p>
                <div class="hero-cta">
                    <a href="/catalog" class="btn btn-glass btn-lg">
                        <i class="fas fa-search me-2"></i>Découvrir le catalogue
                    </a>
                    <a href="tel:+24177468028" class="btn btn-outline" style="background: transparent; color: white; border: 2px solid rgba(255,255,255,0.3);">
                        <i class="fas fa-phone me-2"></i>+241 77 46 80 28
                    </a>
                </div>
                <div class="mt-5" style="display: flex; gap: 2rem; flex-wrap: wrap;">
                    <div>
                        <div style="font-size: 2rem; font-weight: 800; font-family: var(--font-display);">500+</div>
                        <div style="font-size: 0.875rem; color: rgba(255,255,255,0.7);">Événements réussis</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 800; font-family: var(--font-display);">100+</div>
                        <div style="font-size: 0.875rem; color: rgba(255,255,255,0.7);">Produits disponibles</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 800; font-family: var(--font-display);">24h</div>
                        <div style="font-size: 0.875rem; color: rgba(255,255,255,0.7);">Service client</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <div style="position: relative; animation: float 6s ease-in-out infinite;">
                    <div style="width: 400px; height: 400px; margin: 0 auto; background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255,255,255,0.2); box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                        <i class="fas fa-calendar-check" style="font-size: 8rem; opacity: 0.9;"></i>
                    </div>
                    <div style="position: absolute; top: 10%; right: 10%; width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 20px; display: flex; align-items: center; justify-content: center; animation: float 4s ease-in-out infinite;">
                        <i class="fas fa-chair" style="font-size: 2rem;"></i>
                    </div>
                    <div style="position: absolute; bottom: 15%; left: 5%; width: 80px; height: 80px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 20px; display: flex; align-items: center; justify-content: center; animation: float 5s ease-in-out infinite;">
                        <i class="fas fa-utensils" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catégories phares -->
<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3" style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">Nos catégories</h2>
            <p style="color: #64748b;">Découvrez notre gamme complète de matériel événementiel</p>
        </div>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="/catalog?category=<?= $category['id'] ?>" class="text-decoration-none">
                        <div class="category-card">
                            <div class="icon-wrapper">
                                <i class="fas fa-<?= getCategoryIcon($category['nom']) ?>"></i>
                            </div>
                            <h3><?= htmlspecialchars($category['nom']) ?></h3>
                            <p>Voir les produits</p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Produits phares -->
<section class="py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f1f5f9 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3" style="background: linear-gradient(135deg, #0f172a 0%, #334155 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">Produits populaires</h2>
            <p style="color: #64748b; font-size: 1.1rem;">Découvrez nos produits les plus demandés</p>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100" style="border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 12px 40px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'">
                        <div style="position: relative; overflow: hidden;">
                            <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($product['nom']) ?>"
                                 style="height: 250px; object-fit: cover; transition: transform 0.3s ease;"
                                 onmouseover="this.style.transform='scale(1.1)'"
                                 onmouseout="this.style.transform='scale(1)'">
                            <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 0.5rem 1rem; border-radius: 50px; font-weight: 700; color: #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                <i class="fas fa-check-circle me-1"></i>
                                Disponible
                            </div>
                        </div>
                        <div class="card-body" style="padding: 1.5rem;">
                            <div style="margin-bottom: 0.75rem;">
                                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                    <?= htmlspecialchars($product['categorie_nom']) ?>
                                </span>
                            </div>
                            <h5 class="card-title" style="font-weight: 700; color: #1f2937; margin-bottom: 0.75rem;"><?= htmlspecialchars($product['nom']) ?></h5>
                            <p class="card-text" style="color: #6b7280; font-size: 0.95rem; line-height: 1.6;"><?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div>
                                    <div style="font-size: 1.75rem; font-weight: 800; color: #10b981;"><?= number_format($product['prix_location_jour'], 0, ',', ' ') ?> <span style="font-size: 0.875rem; color: #6b7280; font-weight: 500;">FCFA</span></div>
                                    <div style="font-size: 0.75rem; color: #9ca3af;">par jour</div>
                                </div>
                                <a href="/product?id=<?= $product['id'] ?>" class="btn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/catalog" class="btn btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 1rem 3rem; border-radius: 50px; font-weight: 700; box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 32px rgba(102, 126, 234, 0.5)'"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 24px rgba(102, 126, 234, 0.4)'">
                <i class="fas fa-th me-2"></i>Voir tout le catalogue
            </a>
        </div>
    </div>
</section>



<?php include __DIR__ . '/../layout/footer.php'; ?>

<?php
function getCategoryIcon($categoryName) {
    $icons = [
        'Chaises' => 'chair',
        'Tables' => 'table',
        'Tréteaux' => 'hammer',
        'Vaisselle' => 'utensils',
        'Matériel de cuisine' => 'fire-burner',
        'Accessoires' => 'star'
    ];
    return $icons[$categoryName] ?? 'box';
}
?>