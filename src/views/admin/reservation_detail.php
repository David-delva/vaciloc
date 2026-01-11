<?php 
$pageTitle = 'Détail de la réservation #' . $reservation['id'];
ob_start(); 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Réservation #<?= $reservation['id'] ?></h2>
    <a href="/admin/reservations" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Retour
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations client</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nom :</strong> <?= htmlspecialchars($reservation['nom']) ?></p>
                        <p><strong>Prénom :</strong> <?= htmlspecialchars($reservation['prenom']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email :</strong> <?= htmlspecialchars($reservation['email']) ?></p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($reservation['telephone']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Articles réservés</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $detail): ?>
                                <tr>
                                    <td><?= htmlspecialchars($detail['produit_nom']) ?></td>
                                    <td><?= $detail['quantite'] ?></td>
                                    <td><?= number_format($detail['prix_unitaire'], 0, ',', ' ') ?> FCFA</td>
                                    <td><?= number_format($detail['prix_unitaire'] * $detail['quantite'], 0, ',', ' ') ?> FCFA</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Résumé</h5>
            </div>
            <div class="card-body">
                <p><strong>Dates :</strong><br>
                Du <?= date('d/m/Y', strtotime($reservation['date_debut'])) ?><br>
                Au <?= date('d/m/Y', strtotime($reservation['date_fin'])) ?></p>
                
                <p><strong>Statut :</strong><br>
                <span class="badge bg-<?= $reservation['statut'] === 'Confirmée' ? 'success' : 'warning' ?>">
                    <?= $reservation['statut'] ?>
                </span></p>
                
                <p><strong>Total :</strong><br>
                <span class="h4 text-primary"><?= number_format($reservation['total'], 0, ',', ' ') ?> FCFA</span></p>
                
                <form method="POST" action="/admin/update-reservation-status">
                    <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Changer le statut :</label>
                        <select name="statut" class="form-select">
                            <option value="En attente" <?= $reservation['statut'] === 'En attente' ? 'selected' : '' ?>>En attente</option>
                            <option value="Confirmée" <?= $reservation['statut'] === 'Confirmée' ? 'selected' : '' ?>>Confirmée</option>
                            <option value="Terminée" <?= $reservation['statut'] === 'Terminée' ? 'selected' : '' ?>>Terminée</option>
                            <option value="Annulée" <?= $reservation['statut'] === 'Annulée' ? 'selected' : '' ?>>Annulée</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>