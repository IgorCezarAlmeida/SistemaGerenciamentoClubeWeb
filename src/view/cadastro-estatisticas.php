<?php /** @var model\Estatisticas $estatisticas */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Cadastro de Estatísticas</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0"><?= isset($estatisticas) && $estatisticas->getId() ? 'Editar Estatísticas' : 'Cadastro de Estatísticas' ?></h1>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form id="formEstatisticas" action="<?= BASE_URL ?>/estatisticas/cadastrar" method="POST" class="w-100">
            <input type="hidden" name="id" value="<?= htmlspecialchars($estatisticas->getId() ?? '') ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gols" class="form-label">Gols:</label>
                        <input id="gols" name="gols" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getGols() ?? '0') ?>" required min="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="assistencias" class="form-label">Assistências:</label>
                        <input id="assistencias" name="assistencias" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getAssistencias() ?? '0') ?>" required min="0">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="passes" class="form-label">Passes:</label>
                        <input id="passes" name="passes" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getPasses() ?? '0') ?>" required min="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="desarmes" class="form-label">Desarmes:</label>
                        <input id="desarmes" name="desarmes" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getDesarmes() ?? '0') ?>" required min="0">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="defesas" class="form-label">Defesas:</label>
                        <input id="defesas" name="defesas" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getDefesas() ?? '0') ?>" required min="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="minutos_jogados" class="form-label">Minutos Jogados:</label>
                        <input id="minutos_jogados" name="minutos_jogados" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getMinutosJogados() ?? '0') ?>" required min="0">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="jogos" class="form-label">Jogos:</label>
                        <input id="jogos" name="jogos" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getJogos() ?? '0') ?>" required min="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cartoes_amarelos" class="form-label">Cartões Amarelos:</label>
                        <input id="cartoes_amarelos" name="cartoes_amarelos" type="number" class="form-control"
                               value="<?= htmlspecialchars($estatisticas->getCartoesAmarelos() ?? '0') ?>" required min="0">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="cartoes_vermelhos" class="form-label">Cartões Vermelhos:</label>
                <input id="cartoes_vermelhos" name="cartoes_vermelhos" type="number" class="form-control"
                       value="<?= htmlspecialchars($estatisticas->getCartoesVermelhos() ?? '0') ?>" required min="0">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="<?= BASE_URL . '/estatisticas' ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>

