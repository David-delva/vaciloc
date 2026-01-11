<?php 
$pageTitle = 'Gestion des produits';
ob_start(); 
?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-weight: 700; color: #1f2937;">
            <i class="fas fa-box me-2" style="color: #667eea;"></i>
            Gestion des produits
        </h2>
        <p class="text-muted mb-0"><?= count($products) ?> produit(s) au total</p>
    </div>
    <div class="d-flex gap-2 w-100 w-sm-auto">
        <select class="form-select" id="categoryFilter" onchange="filterProducts()" style="border: 2px solid #e5e7eb; border-radius: 10px; max-width: 200px;">
            <option value="">📋 Toutes catégories</option>
            <?php 
            $categories = [];
            foreach ($products as $p) {
                if (!in_array($p['categorie_nom'], $categories)) {
                    $categories[] = $p['categorie_nom'];
                }
            }
            foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <select class="form-select" id="sortProducts" onchange="sortProducts()" style="border: 2px solid #e5e7eb; border-radius: 10px; max-width: 200px;">
            <option value="nom-asc">↑ Nom (A-Z)</option>
            <option value="nom-desc">↓ Nom (Z-A)</option>
            <option value="prix-asc">↑ Prix croissant</option>
            <option value="prix-desc">↓ Prix décroissant</option>
            <option value="stock-asc">↑ Stock croissant</option>
            <option value="stock-desc">↓ Stock décroissant</option>
        </select>
        <a href="/admin/product-form" class="btn btn-primary" style="white-space: nowrap; border-radius: 10px; font-weight: 600;">
            <i class="fas fa-plus me-2"></i>Ajouter
        </a>
    </div>
</div>

<?php if (empty($products)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Aucun produit</h4>
            <p class="text-muted">Commencez par ajouter votre premier produit.</p>
            <a href="/admin/product-form" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Ajouter un produit
            </a>
        </div>
    </div>
<?php else: ?>
    <!-- Vue desktop -->
    <div class="card d-none d-lg-block" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px; overflow: hidden;">
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="productsTable">
                    <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <tr>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Image</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Nom</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Catégorie</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Prix/jour</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Stock</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr data-category="<?= htmlspecialchars($product['categorie_nom']) ?>" data-name="<?= htmlspecialchars($product['nom']) ?>" data-price="<?= $product['prix_location_jour'] ?>" data-stock="<?= $product['quantite_totale'] ?>" style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                                         alt="<?= htmlspecialchars($product['nom']) ?>"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <div style="font-weight: 600; color: #1f2937;"><?= htmlspecialchars($product['nom']) ?></div>
                                    <small style="color: #6b7280;"><?= htmlspecialchars(substr($product['description'], 0, 50)) ?>...</small>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <span style="background: #e0e7ff; color: #4338ca; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.875rem;"><?= htmlspecialchars($product['categorie_nom']) ?></span>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <strong style="color: #10b981; font-size: 1.1rem;"><?= number_format($product['prix_location_jour'], 0, ',', ' ') ?> FCFA</strong>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <span style="background: <?= $product['quantite_totale'] > 0 ? '#d1fae5' : '#fee2e2' ?>; color: <?= $product['quantite_totale'] > 0 ? '#065f46' : '#991b1b' ?>; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.875rem;">
                                        <?= $product['quantite_totale'] ?> unité(s)
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-info" 
                                                onclick="previewProduct(<?= $product['id'] ?>)" 
                                                title="Aperçu">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="/admin/product-form?id=<?= $product['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="/admin/delete-product?id=<?= $product['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Vue mobile/tablette -->
    <div class="d-lg-none">
        <?php foreach ($products as $product): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="/images/<?= htmlspecialchars($product['image_url']) ?>" 
                                 alt="<?= htmlspecialchars($product['nom']) ?>"
                                 class="img-fluid rounded"
                                 style="height: 60px; object-fit: cover;">
                        </div>
                        <div class="col-9">
                            <h6 class="mb-1"><?= htmlspecialchars($product['nom']) ?></h6>
                            <div class="mb-2">
                                <span class="badge bg-secondary me-2"><?= htmlspecialchars($product['categorie_nom']) ?></span>
                                <span class="badge <?= $product['quantite_totale'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $product['quantite_totale'] ?> unités
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-primary"><?= number_format($product['prix_location_jour'], 0, ',', ' ') ?> FCFA/j</strong>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-info" onclick="previewProduct(<?= $product['id'] ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="/admin/product-form?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/delete-product?id=<?= $product['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Supprimer ce produit ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Modale de prévisualisation -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aperçu du produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="previewContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewProduct(id) {
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    const content = document.getElementById('previewContent');
    
    // Afficher le loader
    content.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
        </div>
    `;
    
    modal.show();
    
    // Charger les données du produit
    fetch('/admin/product-preview?id=' + id)
        .then(response => response.json())
        .then(product => {
            content.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <img src="/images/${product.image_url}" 
                             class="img-fluid rounded" 
                             alt="${product.nom}"
                             style="max-height: 400px; object-fit: cover; width: 100%;">
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-3">${product.nom}</h3>
                        <div class="mb-3">
                            <span class="badge bg-secondary">${product.categorie_nom}</span>
                        </div>
                        <div class="mb-3">
                            <h4 class="text-primary">${parseInt(product.prix_location_jour).toLocaleString('fr-FR')} FCFA <small class="text-muted">/ jour</small></h4>
                        </div>
                        <div class="mb-3">
                            <h6>Description</h6>
                            <p class="text-muted">${product.description || 'Aucune description'}</p>
                        </div>
                        <div class="mb-3">
                            <h6>Disponibilité</h6>
                            <p class="text-success">
                                <i class="fas fa-check-circle me-2"></i>
                                ${product.quantite_totale} unité(s) en stock
                            </p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/admin/product-form?id=${product.id}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                            <a href="/product?id=${product.id}" target="_blank" class="btn btn-outline-secondary">
                                <i class="fas fa-external-link-alt me-2"></i>Voir sur le site
                            </a>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            content.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Erreur lors du chargement du produit
                </div>
            `;
        });
}

function filterProducts() {
    const category = document.getElementById('categoryFilter').value;
    const rows = document.querySelectorAll('#productsTable tbody tr');
    
    rows.forEach(row => {
        const rowCategory = row.getAttribute('data-category');
        if (category === '' || rowCategory === category) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function sortProducts() {
    const sortBy = document.getElementById('sortProducts').value;
    const tbody = document.querySelector('#productsTable tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        let aVal, bVal;
        
        switch(sortBy) {
            case 'nom-asc':
                aVal = a.getAttribute('data-name').toLowerCase();
                bVal = b.getAttribute('data-name').toLowerCase();
                return aVal.localeCompare(bVal);
            case 'nom-desc':
                aVal = a.getAttribute('data-name').toLowerCase();
                bVal = b.getAttribute('data-name').toLowerCase();
                return bVal.localeCompare(aVal);
            case 'prix-asc':
                aVal = parseFloat(a.getAttribute('data-price'));
                bVal = parseFloat(b.getAttribute('data-price'));
                return aVal - bVal;
            case 'prix-desc':
                aVal = parseFloat(a.getAttribute('data-price'));
                bVal = parseFloat(b.getAttribute('data-price'));
                return bVal - aVal;
            case 'stock-asc':
                aVal = parseInt(a.getAttribute('data-stock'));
                bVal = parseInt(b.getAttribute('data-stock'));
                return aVal - bVal;
            case 'stock-desc':
                aVal = parseInt(a.getAttribute('data-stock'));
                bVal = parseInt(b.getAttribute('data-stock'));
                return bVal - aVal;
        }
    });
    
    rows.forEach(row => tbody.appendChild(row));
}
</script>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>