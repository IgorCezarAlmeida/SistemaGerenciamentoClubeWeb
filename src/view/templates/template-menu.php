<?php
// template-sidebar.php
// Sidebar lateral esquerdo responsivo (desktop fixo / mobile offcanvas).
// Usa BASE_URL e session já iniciada.

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
$currentPath = substr($uri, strlen($basePath)) ?: '/';

function isActive(string $prefix, string $currentPath): string {
    return (strpos($currentPath, $prefix) === 0) ? 'active' : '';
}

$logado = !empty($_SESSION['tecnico_id']);
$tecnicoNome = $_SESSION['tecnico_nome'] ?? 'Convidado';
?>

    <!-- Toggle button (apenas mobile) -->
    <nav class="d-lg-none navbar bg-light">
        <div class="container-fluid">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                ☰ Menu
            </button>
            <a class="navbar-brand ms-2" href="<?= BASE_URL ?>/">Sistema Clube</a>
        </div>
    </nav>

    <!-- Offcanvas para mobile -->
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Navegação</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body p-0">
            <?php include __DIR__ . '/_sidebar_content.php'; ?>
        </div>
    </div>

    <!-- Sidebar fixo para desktop -->
    <div class="d-none d-lg-block">
        <aside id="appSidebar" class="bg-light border-end" style="width: 250px; min-height: 100vh; position: fixed; top:0; left:0; overflow:auto;">
            <div class="p-3">
                <a class="d-flex align-items-center mb-3 text-decoration-none" href="<?= BASE_URL ?>/">
                    <!-- se tiver imagem: <img src="<?= BASE_URL ?>/assets/img/logo.png" ...> -->
                    <div style="width:44px;height:44px;border-radius:8px;background:#667eea;color:white;display:flex;align-items:center;justify-content:center;font-weight:700;margin-right:12px;">
                        SC
                    </div>
                    <div>
                        <strong>Sistema Clube</strong><br>
                        <small class="text-muted">Painel Técnico</small>
                    </div>
                </a>

                <div class="mb-3">
                    <div class="small text-muted">Logado como</div>
                    <div class="fw-semibold"><?= htmlspecialchars($tecnicoNome) ?></div>
                </div>

                <hr>

                <ul class="nav nav-pills flex-column mb-3">
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/dashboard" class="nav-link <?= isActive('/dashboard', $currentPath) ?>">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/jogadores" class="nav-link <?= isActive('/jogadores', $currentPath) ?>">
                            <i class="bi bi-people me-2"></i> Jogadores
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/treinos" class="nav-link <?= isActive('/treinos', $currentPath) ?>">
                            <i class="bi bi-calendar-check me-2"></i> Treinos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/estatisticas" class="nav-link <?= isActive('/estatisticas', $currentPath) ?>">
                            <i class="bi bi-bar-chart-line me-2"></i> Estatísticas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/relatorios" class="nav-link <?= isActive('/relatorios', $currentPath) ?>">
                            <i class="bi bi-file-earmark-text me-2"></i> Relatórios
                        </a>
                    </li>
                </ul>

                <div class="mt-auto">
                    <hr>
                    <?php if ($logado): ?>
                        <a href="<?= BASE_URL ?>/perfil" class="d-block mb-2 text-decoration-none"><i class="bi bi-person-circle me-2"></i> Meu Perfil</a>
                        <a href="<?= BASE_URL ?>/logout" class="btn btn-outline-danger w-100"><i class="bi bi-box-arrow-right me-2"></i> Sair</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>/login" class="btn btn-primary w-100">Entrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </aside>
    </div>

    <!-- Espaço à direita do sidebar para o conteúdo -->
    <div style="margin-left: 0;" class="content-with-sidebar d-lg-block">
        <div class="container-fluid" style="margin-left: 250px; padding-top: 20px;">
            <!-- conteúdo da página deve ficar abaixo deste container (ou ajuste seu layout para usar margin-left) -->
        </div>
    </div>

<?php
// Cria um arquivo parcial com o mesmo conteúdo do sidebar (para incluir no offcanvas)
// Salvamos a string aqui para facilitar: se preferir, crie um arquivo físico _sidebar_content.php com o mesmo markup do lado fixo.
?>

<?php
// Gera o conteúdo do sidebar para offcanvas (mobile). Para simplificar, gravamos em string e incluímos com eval-like include.
// Melhor opção: criar um arquivo _sidebar_content.php com o mesmo markup do sidebar fixo.
// Aqui, vamos escrever o conteúdo no diretório de templates se ainda não existir. (Se não quiser, copie manualmente.)
?>