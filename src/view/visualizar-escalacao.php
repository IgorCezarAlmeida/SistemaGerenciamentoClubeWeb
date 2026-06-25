<?php /** @var model\Escalacao $escalacao */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Visualizar Escalação</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Detalhes da Escalação</h1>
        <a href="<?= BASE_URL . '/escalacoes' ?>" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($escalacao)) : ?>
            <div class="card neo-card p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-card-checklist"></i> Esquema Tático</h5>
                <p class="card-text mb-4"><?= htmlspecialchars($escalacao->getEsquemaTatico() ?? 'N/A') ?></p>

                <h5 class="fw-bold mb-3"><i class="bi bi-list-check"></i> Instruções Gerais</h5>
                <p class="card-text"><?= htmlspecialchars($escalacao->getInstrucoesGerais() ?? 'N/A') ?></p>

                <div class="mt-4 pt-4 border-top">
                    <a href="<?= BASE_URL . '/escalacoes/' . $escalacao->getId() . '/editar' ?>" class="btn btn-warning">Editar</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>

