<?php
$logado = $dadosDashboard['logado'] ?? !empty($_SESSION['tecnico_id']);
$tecnicoNome = $dadosDashboard['tecnico_nome'] ?? $_SESSION['tecnico_nome'] ?? 'Convidado';
?>
<?php $nomeTime = $dadosDashboard['nome_time'] ?? null; ?>

<?php if (!empty($nomeTime)): ?>
    <small class="text-muted d-block"><?php echo htmlspecialchars($nomeTime); ?></small>
<?php endif; ?>

<style>
    body {
        background-color: #e5e7eb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar {
        background-color: #111827;
        min-height: 100vh;
        color: #fff;
        border-right: 2px solid #000;
    }

    .sidebar .nav-link {
        color: #9ca3af;
        margin-bottom: 5px;
        padding: 10px 15px;
        font-weight: 500;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover {
        color: #fff;
    }

    .sidebar .nav-link.active {
        background-color: #f97316;
        color: #fff;
        border-radius: 6px;
        box-shadow: 3px 3px 0px #000;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background-color: #1f2937;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        background-color: #f97316;
        border: 2px solid #000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border-radius: 4px;
    }
</style>

<div class="sidebar p-3" style="width: 250px;">
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