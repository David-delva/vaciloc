<?php 
$pageTitle = 'Tableau de bord';
ob_start(); 
?>

<!-- Statistiques Premium -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon" style="background: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-clock fa-2x"></i>
                </div>
                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 6px 12px;">+12%</span>
            </div>
            <div class="stat-value counter" data-target="<?= $stats['nouvelles_demandes'] ?>" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
            <div class="stat-label" style="opacity: 0.9; font-size: 0.95rem;">Nouvelles demandes</div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon" style="background: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 6px 12px;">+8%</span>
            </div>
            <div class="stat-value counter" data-target="<?= $stats['reservations_a_venir'] ?>" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
            <div class="stat-label" style="opacity: 0.9; font-size: 0.95rem;">Réservations à venir</div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon" style="background: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-box fa-2x"></i>
                </div>
                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 6px 12px;">+5%</span>
            </div>
            <div class="stat-value counter" data-target="<?= $stats['total_produits'] ?>" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">0</div>
            <div class="stat-label" style="opacity: 0.9; font-size: 0.95rem;">Produits en stock</div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; border: none;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="stat-icon" style="background: rgba(255,255,255,0.2); width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-coins fa-2x"></i>
                </div>
                <span class="badge" style="background: rgba(255,255,255,0.2); padding: 6px 12px;">Ce mois</span>
            </div>
            <div class="stat-value" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;"><?= number_format($stats['revenu_total'] ?? 0, 0) ?></div>
            <div class="stat-label" style="opacity: 0.9; font-size: 0.95rem;">Revenus (FCFA)</div>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <a href="/admin/product-form" class="btn btn-primary w-100" style="padding: 1rem; font-weight: 600;">
            <i class="fas fa-plus-circle me-2"></i>
            Ajouter Produit
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="/admin/products" class="btn btn-outline-primary w-100" style="padding: 1rem; font-weight: 600;">
            <i class="fas fa-box me-2"></i>
            Gérer Produits
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="/admin/reservations" class="btn btn-outline-secondary w-100" style="padding: 1rem; font-weight: 600;">
            <i class="fas fa-calendar-alt me-2"></i>
            Réservations
        </a>
    </div>
    <div class="col-6 col-lg-3">
        <a href="/" target="_blank" class="btn btn-outline-dark w-100" style="padding: 1rem; font-weight: 600;">
            <i class="fas fa-external-link-alt me-2"></i>
            Voir Site
        </a>
    </div>
</div>

<!-- Réservations récentes -->
<div class="card" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); border-radius: 16px; overflow: hidden;">
    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border: none;">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0" style="font-weight: 700; font-size: 1.25rem;">
                <i class="fas fa-list-alt me-2"></i>
                Réservations récentes
            </h5>
            <a href="/admin/reservations" class="btn btn-light btn-sm" style="font-weight: 600;">
                Voir toutes <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <?php if (empty($recentReservations)): ?>
            <div style="text-align: center; padding: 4rem 2rem; color: var(--gray-500);">
                <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                    <i class="fas fa-inbox fa-3x" style="color: white;"></i>
                </div>
                <h6 style="font-weight: 600; margin-bottom: 0.5rem;">Aucune réservation</h6>
                <p class="mb-0" style="color: var(--gray-400);">Les nouvelles réservations apparaîtront ici.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="min-width: 100%;">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">ID</th>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">Client</th>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">Période</th>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">Montant</th>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">Statut</th>
                            <th style="padding: 1rem; font-weight: 600; color: #6c757d; border: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentReservations as $reservation): ?>
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 12px; border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                        #<?= $reservation['id'] ?>
                                    </span>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <div style="font-weight: 600; color: #1f2937; margin-bottom: 2px;">
                                        <?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) ?>
                                    </div>
                                    <small style="color: #6b7280;">
                                        <i class="fas fa-envelope me-1" style="font-size: 0.75rem;"></i>
                                        <?= htmlspecialchars($reservation['email']) ?>
                                    </small>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <div style="font-weight: 500; color: #1f2937;">
                                        <i class="fas fa-calendar me-1" style="color: #667eea;"></i>
                                        <?= date('d/m/Y', strtotime($reservation['date_debut'])) ?>
                                    </div>
                                    <small style="color: #6b7280;">
                                        <i class="fas fa-arrow-right me-1" style="font-size: 0.7rem;"></i>
                                        <?= date('d/m/Y', strtotime($reservation['date_fin'])) ?>
                                    </small>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <strong style="color: #10b981; font-size: 1.1rem;">
                                        <?= number_format($reservation['total'], 0, ',', ' ') ?> FCFA
                                    </strong>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <?php
                                    $statusConfig = match($reservation['statut']) {
                                        'En attente' => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'clock'],
                                        'Confirmée' => ['bg' => '#d1fae5', 'color' => '#065f46', 'icon' => 'check-circle'],
                                        'Terminée' => ['bg' => '#e0e7ff', 'color' => '#3730a3', 'icon' => 'flag-checkered'],
                                        'Annulée' => ['bg' => '#fee2e2', 'color' => '#991b1b', 'icon' => 'times-circle'],
                                        default => ['bg' => '#f3f4f6', 'color' => '#374151', 'icon' => 'question']
                                    };
                                    ?>
                                    <span style="background: <?= $statusConfig['bg'] ?>; color: <?= $statusConfig['color'] ?>; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-<?= $statusConfig['icon'] ?>" style="font-size: 0.75rem;"></i>
                                        <?= $reservation['statut'] ?>
                                    </span>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                        <select name="statut" class="form-select form-select-sm" style="min-width: 140px; border-radius: 8px; border: 2px solid #e5e7eb; font-weight: 500;" onchange="this.form.submit()">
                                            <option value="En attente" <?= $reservation['statut'] === 'En attente' ? 'selected' : '' ?>>⏳ En attente</option>
                                            <option value="Confirmée" <?= $reservation['statut'] === 'Confirmée' ? 'selected' : '' ?>>✅ Confirmée</option>
                                            <option value="Terminée" <?= $reservation['statut'] === 'Terminée' ? 'selected' : '' ?>>🏁 Terminée</option>
                                            <option value="Annulée" <?= $reservation['statut'] === 'Annulée' ? 'selected' : '' ?>>❌ Annulée</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>