<?php /** @var model\Treino $treino */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/templates/template-head.php' ?>
    <title>Cadastro do Treino</title>
</head>
<body class="container">
<?php require_once "templates/template-menu.php" ?>

<div class="mt-5">
    <h1><?= isset($treino) && $treino->getId() ? 'Editar Treino' : 'Cadastro de Treino' ?></h1>

    <?php if (!empty($erro)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($erro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <form id="formTreino" action="<?= BASE_URL ?>/treinos/cadastrar" method="POST">
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

        <div class="btn-group" role="group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= BASE_URL . '/treinos' ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . "/templates/template-rodape.php" ?>
</body>
</html>


