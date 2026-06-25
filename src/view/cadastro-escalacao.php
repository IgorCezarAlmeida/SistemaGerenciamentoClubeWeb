<?php /** @var model\Escalacao $escalacao */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Cadastro de Escalação</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0"><?= isset($escalacao) && $escalacao->getId() ? 'Editar Escalação' : 'Cadastro de Escalação' ?></h1>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form id="formEscalacao" action="<?= BASE_URL ?>/escalacoes/cadastrar" method="POST" class="w-100">
            <input type="hidden" name="id" value="<?= htmlspecialchars($escalacao->getId() ?? '') ?>">

            <div class="mb-3">
                <label for="esquema_tatico" class="form-label">Esquema Tático:</label>
                <input id="esquema_tatico" name="esquema_tatico" type="text" class="form-control"
                       placeholder="Ex: 4-3-3, 5-3-2" value="<?= htmlspecialchars($escalacao->getEsquemaTatico() ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="instrucoes_gerais" class="form-label">Instruções Gerais:</label>
                <textarea id="instrucoes_gerais" name="instrucoes_gerais" class="form-control" rows="6" required><?= htmlspecialchars($escalacao->getInstrucoesGerais() ?? '') ?></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="<?= BASE_URL . '/escalacoes' ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>



