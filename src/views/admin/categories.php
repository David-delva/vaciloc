<?php 
$pageTitle = 'Gestion des catégories';
ob_start(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des catégories</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fas fa-plus me-2"></i>Ajouter une catégorie
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Nombre de produits</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $category['id'] ?></td>
                            <td><strong><?= htmlspecialchars($category['nom']) ?></strong></td>
                            <td><span class="badge bg-info"><?= $category['nb_produits'] ?? 0 ?> produit(s)</span></td>
                            <td><?= date('d/m/Y', strtotime($category['created_at'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" 
                                        onclick="editCategory(<?= $category['id'] ?>, '<?= htmlspecialchars($category['nom']) ?>')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/admin/delete-category?id=<?= $category['id'] ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Supprimer cette catégorie ?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/admin/add-category">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modifier -->
<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/admin/edit-category">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCategoryId">
                    <div class="mb-3">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" name="nom" id="editCategoryName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editCategory(id, nom) {
    document.getElementById('editCategoryId').value = id;
    document.getElementById('editCategoryName').value = nom;
    new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
}
</script>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>