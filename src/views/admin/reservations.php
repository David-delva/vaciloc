<?php 
$pageTitle = 'Gestion des réservations';
ob_start(); 
?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
        <h2 class="mb-1" style="font-weight: 700; color: #1f2937;">
            <i class="fas fa-calendar-check me-2" style="color: #667eea;"></i>
            Gestion des réservations
        </h2>
        <p class="text-muted mb-0">Gérez et suivez toutes vos réservations</p>
    </div>
    <div class="w-100 w-sm-auto">
        <select class="form-select" id="statusFilter" onchange="filterReservations()" style="border: 2px solid #e5e7eb; border-radius: 10px; padding: 0.6rem 1rem; font-weight: 500;">
            <option value="">📋 Tous les statuts</option>
            <option value="En attente">⏳ En attente</option>
            <option value="Confirmée">✅ Confirmée</option>
            <option value="Terminée">🏁 Terminée</option>
            <option value="Annulée">❌ Annulée</option>
        </select>
    </div>
</div>

<?php if (empty($reservations)): ?>
    <div class="card" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px;">
        <div class="card-body text-center py-5">
            <div style="width: 100px; height: 100px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                <i class="fas fa-calendar-times fa-3x" style="color: white;"></i>
            </div>
            <h4 style="font-weight: 600; color: #1f2937;">Aucune réservation</h4>
            <p class="text-muted">Les réservations apparaîtront ici.</p>
        </div>
    </div>
<?php else: ?>
    <!-- Vue desktop -->
    <div class="card d-none d-lg-block" style="border: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 16px; overflow: hidden;">
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="reservationsTable">
                    <thead style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <tr>
                            <th style="padding: 1rem; border: none; font-weight: 600;">ID</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Client</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Contact</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Dates</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Total</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Statut</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Créée le</th>
                            <th style="padding: 1rem; border: none; font-weight: 600;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr data-status="<?= $reservation['statut'] ?>" style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4px 12px; border-radius: 8px; font-weight: 600; font-size: 0.875rem;">
                                        #<?= $reservation['id'] ?>
                                    </span>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle; min-width: 150px;">
                                    <div style="font-weight: 600; color: #1f2937;"><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) ?></div>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle; min-width: 180px;">
                                    <div style="font-size: 0.875rem; color: #6b7280;">
                                        <div class="mb-1"><i class="fas fa-envelope me-1" style="color: #667eea;"></i><?= htmlspecialchars($reservation['email']) ?></div>
                                        <div><i class="fas fa-phone me-1" style="color: #667eea;"></i><?= htmlspecialchars($reservation['telephone']) ?></div>
                                    </div>
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
                                    <?php
                                    $debut = new DateTime($reservation['date_debut']);
                                    $fin = new DateTime($reservation['date_fin']);
                                    $jours = $debut->diff($fin)->days + 1;
                                    ?>
                                    <div><small style="background: #dbeafe; color: #1e40af; padding: 2px 8px; border-radius: 6px; font-weight: 500;"><?= $jours ?> jour<?= $jours > 1 ? 's' : '' ?></small></div>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <strong style="color: #10b981; font-size: 1.1rem;"><?= number_format($reservation['total'], 0, ',', ' ') ?> FCFA</strong>
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
                                    <small style="color: #6b7280;"><?= date('d/m/Y H:i', strtotime($reservation['created_at'])) ?></small>
                                </td>
                                <td style="padding: 1rem; vertical-align: middle;">
                                    <div class="btn-group" role="group">
                                        <a href="/admin/reservation-detail?id=<?= $reservation['id'] ?>" 
                                           class="btn btn-sm" 
                                           style="background: #dbeafe; color: #1e40af; border: none; font-weight: 500;"
                                           title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <div class="btn-group" role="group">
                                            <button type="button" 
                                                    class="btn btn-sm dropdown-toggle" 
                                                    style="background: #e0e7ff; color: #4338ca; border: none; font-weight: 500;"
                                                    data-bs-toggle="dropdown">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                                        <input type="hidden" name="statut" value="En attente">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-clock me-2 text-warning"></i>En attente
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                                        <input type="hidden" name="statut" value="Confirmée">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-check me-2 text-success"></i>Confirmée
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                                        <input type="hidden" name="statut" value="Terminée">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-flag-checkered me-2 text-secondary"></i>Terminée
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                                        <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                                        <input type="hidden" name="statut" value="Annulée">
                                                        <button type="submit" class="dropdown-item text-danger"
                                                                onclick="return confirm('Annuler cette réservation ?')">
                                                            <i class="fas fa-times me-2"></i>Annulée
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
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
        <?php foreach ($reservations as $reservation): ?>
            <div class="card mb-3" data-status="<?= $reservation['statut'] ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h6 class="mb-0">#<?= $reservation['id'] ?> - <?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) ?></h6>
                        <?php
                        $badgeClass = match($reservation['statut']) {
                            'En attente' => 'bg-warning text-dark',
                            'Confirmée' => 'bg-success',
                            'Terminée' => 'bg-secondary',
                            'Annulée' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= $reservation['statut'] ?></span>
                    </div>
                    
                    <div class="small text-muted mb-2">
                        <i class="fas fa-envelope me-1"></i><?= htmlspecialchars($reservation['email']) ?><br>
                        <i class="fas fa-phone me-1"></i><?= htmlspecialchars($reservation['telephone']) ?>
                    </div>
                    
                    <div class="mb-2">
                        <strong><?= date('d/m/Y', strtotime($reservation['date_debut'])) ?></strong> au 
                        <strong><?= date('d/m/Y', strtotime($reservation['date_fin'])) ?></strong>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <strong class="text-primary"><?= number_format($reservation['total'], 0, ',', ' ') ?> FCFA</strong>
                        <div class="btn-group">
                            <a href="/admin/reservation-detail?id=<?= $reservation['id'] ?>" 
                               class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="btn-group" role="group">
                                <button type="button" 
                                        class="btn btn-sm btn-outline-primary dropdown-toggle" 
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                            <input type="hidden" name="statut" value="En attente">
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-clock me-2 text-warning"></i>En attente
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                            <input type="hidden" name="statut" value="Confirmée">
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-check me-2 text-success"></i>Confirmée
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                            <input type="hidden" name="statut" value="Terminée">
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-flag-checkered me-2 text-secondary"></i>Terminée
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="/admin/update-reservation-status" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $reservation['id'] ?>">
                                            <input type="hidden" name="statut" value="Annulée">
                                            <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Annuler cette réservation ?')">
                                                <i class="fas fa-times me-2"></i>Annulée
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
function filterReservations() {
    const filter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#reservationsTable tbody tr');
    const cards = document.querySelectorAll('.d-lg-none .card[data-status]');
    
    // Filtrer les lignes du tableau (desktop)
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (filter === '' || status === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Filtrer les cards (mobile)
    cards.forEach(card => {
        const status = card.getAttribute('data-status');
        if (filter === '' || status === filter) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php 
$content = ob_get_clean();
include __DIR__ . '/layout.php'; 
include __DIR__ . '/layout_footer.php';
?>