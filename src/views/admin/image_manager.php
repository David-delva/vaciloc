<?php 
$pageTitle = 'Gestionnaire d\'images';
ob_start(); 
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
    <h2 class="mb-3 mb-md-0">Gestionnaire d'images</h2>
    <button class="btn btn-primary w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#uploadModal">
        <i class="fas fa-upload me-2"></i>Uploader une image
    </button>
</div>

<div class="row">
    <?php
    $imageDir = realpath(__DIR__ . '/../../public/images/');
    
    if ($imageDir && is_dir($imageDir)) {
        $images = array_diff(scandir($imageDir), array('.', '..'));
    } else {
        // Créer le dossier s'il n'existe pas
        $imageDir = __DIR__ . '/../../public/images/';
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }
        $images = [];
    }
    
    foreach ($images as $image):
        if (in_array(strtolower(pathinfo($image, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])):
    ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
            <div class="card h-100">
                <img src="/images/<?= htmlspecialchars($image) ?>" 
                     class="card-img-top" 
                     style="height: 150px; object-fit: cover;"
                     alt="<?= htmlspecialchars($image) ?>">
                <div class="card-body p-2 d-flex flex-column">
                    <h6 class="card-title small text-truncate mb-2" title="<?= htmlspecialchars($image) ?>"><?= htmlspecialchars($image) ?></h6>
                    <div class="btn-group w-100 mt-auto">
                        <button class="btn btn-sm btn-outline-primary" 
                                onclick="copyImageName('<?= htmlspecialchars($image) ?>')" 
                                title="Copier le nom">
                            <i class="fas fa-copy"></i>
                        </button>
                        <a href="/admin/delete-image?name=<?= urlencode($image) ?>" 
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Supprimer cette image ?')"
                           title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php 
        endif;
    endforeach; 
    ?>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="uploadModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="/admin/upload-image" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Uploader une image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sélectionner une image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                        <div class="form-text">Formats acceptés : JPG, PNG, GIF (max 5MB)</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Uploader</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function copyImageName(imageName) {
    navigator.clipboard.writeText(imageName).then(function() {
        alert('Nom de l\'image copié : ' + imageName);
    });
}
</script>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>