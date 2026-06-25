<?php /** @var model\Treino $treino */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Visualizar Treino</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Detalhes do Treino</h1>
        <a href="<?= BASE_URL . '/treinos' ?>" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($treino)) : ?>
            <div class="card neo-card p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-activity"></i> Esquema Tático</h5>
                <p class="card-text mb-4"><?= htmlspecialchars($treino->getFocoTatico() ?? 'N/A') ?></p>

                <h5 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Instruções Gerais</h5>
                <p class="card-text mb-4"><?= htmlspecialchars($treino->getIntensidade() ?? 'N/A') ?></p>

                <h5 class="fw-bold mb-3"><i class="bi bi-cloud-sun"></i> Clima</h5>
                <p class="card-text mb-4"><?= htmlspecialchars($treino->getClima() ?? 'N/A') ?></p>

                <h5 class="fw-bold mb-3"><i class="bi bi-card-text"></i> Descrição</h5>
                <p class="card-text"><?= htmlspecialchars($treino->getDescricao() ?? 'N/A') ?></p>

                <div class="mt-4 pt-4 border-top">
                    <a href="<?= BASE_URL . '/treinos/' . $treino->getId() . '/editar' ?>" class="btn btn-warning">Editar</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>

