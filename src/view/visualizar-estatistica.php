<?php /** @var model\Estatisticas $estatistica */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Visualizar Estatística</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Detalhes da Estatística</h1>
        <a href="<?= BASE_URL . '/estatisticas' ?>" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($estatistica)) : ?>
            <div class="card neo-card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="bi bi-basketball"></i> Gols</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getGols() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-hand-thumbs-up"></i> Assistências</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getAssistencias() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-diagram-3"></i> Passes</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getPasses() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-shield-check"></i> Desarmes</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getDesarmes() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-person-lock"></i> Defesas</h5>
                        <p class="card-text"><?= htmlspecialchars($estatistica->getDefesas() ?? 0) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="bi bi-hourglass-split"></i> Minutos Jogados</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getMinutosJogados() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-list-ol"></i> Jogos</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getJogos() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-exclamation-circle"></i> Cartões Amarelos</h5>
                        <p class="card-text mb-4"><?= htmlspecialchars($estatistica->getCartoesAmarelos() ?? 0) ?></p>

                        <h5 class="fw-bold mb-3"><i class="bi bi-exclamation-octagon"></i> Cartões Vermelhos</h5>
                        <p class="card-text"><?= htmlspecialchars($estatistica->getCartoesVermelhos() ?? 0) ?></p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <a href="<?= BASE_URL . '/estatisticas/' . $estatistica->getId() . '/editar' ?>" class="btn btn-warning">Editar</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>

