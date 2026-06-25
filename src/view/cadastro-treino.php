<?php /** @var model\Treino $treino */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Cadastro do Treino</title>

<?php require_once "templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0"><?= isset($treino) && $treino->getId() ? 'Editar Treino' : 'Cadastro de Treino' ?></h1>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form id="formTreino" action="<?= BASE_URL ?>/treinos/cadastrar" method="POST" class="w-100">
            <input type="hidden" name="id" value="<?= htmlspecialchars($treino->getId() ?? '') ?>">

            <div class="mb-3">
                <label for="esquema_tatico" class="form-label">Esquema Tático:</label>
                <input id="esquema_tatico" name="esquema_tatico" type="text" class="form-control"
                       value="<?= htmlspecialchars($treino->getFocoTatico() ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="instrucoes_gerais" class="form-label">Instruções Gerais:</label>
                <textarea id="instrucoes_gerais" name="instrucoes_gerais" class="form-control" rows="4" required><?= htmlspecialchars($treino->getIntensidade() ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="clima" class="form-label">Clima:</label>
                <input id="clima" name="clima" type="text" class="form-control"
                       value="<?= htmlspecialchars($treino->getClima() ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?= htmlspecialchars($treino->getDescricao() ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="<?= BASE_URL . '/treinos' ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>


