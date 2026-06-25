<?php
$logado = $dadosDashboard['logado'] ?? !empty($_SESSION['tecnico_id']);
$tecnicoNome = $dadosDashboard['tecnico_nome'] ?? $_SESSION['tecnico_nome'] ?? 'Convidado';
?>

<div class="sidebar p-3">
    <h4 class="text-white mb-4 d-flex align-items-center">
        <i class="bi bi-shield-shaded text-warning me-2"></i> TACTICAL PRO
    </h4>

    <?php if ($logado): ?>
        <div class="user-info mb-4">
            <div class="user-avatar">
                <?php echo strtoupper(substr($tecnicoNome, 0, 1)); ?>
            </div>
            <div>
                <small class="text-muted d-block">Técnico</small>
                <strong class="text-white"><?php echo htmlspecialchars($tecnicoNome); ?></strong>
            </div>
        </div>
    <?php endif; ?>

    <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo BASE_URL; ?>/menu">
                <i class="bi bi-grid-1x2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>/jogadores">
                <i class="bi bi-people me-2"></i> Jogadores
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>/escalacoes">
                <i class="bi bi-card-checklist me-2"></i> Escalações
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>/estatisticas">
                <i class="bi bi-bar-chart-line me-2"></i> Estatísticas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>/treinos">
                <i class="bi bi-activity me-2"></i> Treinos
            </a>
        </li>
    </ul>

    <div class="pt-3 border-top border-secondary mt-auto">
        <a class="nav-link text-danger logout-link" href="<?php echo BASE_URL; ?>/logout">
            <i class="bi bi-box-arrow-right me-2"></i> Sair
        </a>
    </div>
</div>