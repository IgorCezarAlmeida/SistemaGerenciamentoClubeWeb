<?php /**  @var model\Jogador $jogador ; */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Cadastro do Jogador</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

     <div class="content-header">
        <h1 class="m-0"><?= isset($jogador) && $jogador->getId() ? 'Editar Jogador' : 'Cadastro de Jogador' ?></h1>
    </div>

    <div class="content-body">
        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form id="formJogador" action="<?= BASE_URL ?>/jogadores/cadastrar" method="POST" class="w-100">
            <input type="hidden" name="id" value="<?= htmlspecialchars($jogador->getId() ?? '') ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input id="nome" name="nome" type="text" class="form-control" value="<?= htmlspecialchars($jogador->getNome() ?? '') ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="numeroCamisa" class="form-label">Número Camisa:</label>
                        <input id="numeroCamisa" name="numeroCamisa" type="number" class="form-control" value="<?= htmlspecialchars($jogador->getNumeroCamisa() ?? '') ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="pesoKG" class="form-label">Peso (kg):</label>
                        <input id="pesoKG" name="pesoKG" type="number" class="form-control" step="0.1" value="<?= htmlspecialchars($jogador->getPesoKG() ?? '') ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="alturaCM" class="form-label">Altura (cm):</label>
                        <input id="alturaCM" name="alturaCM" type="number" class="form-control" value="<?= htmlspecialchars($jogador->getAlturaCM() ?? '') ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                        <input id="data_nascimento" name="data_nascimento" type="date" class="form-control" value="<?= htmlspecialchars($jogador->getDataNascimento() ?? '') ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="3"><?= htmlspecialchars($jogador->getDescricao() ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="disponivel" class="form-label">Situação:</label>
                <select id="disponivel" name="disponivel" class="form-select" required>
                    <option value="">Selecione uma opção</option>
                    <option value="disponível" <?= ($jogador->getDisponivel() ?? '') === 'disponível' ? 'selected' : '' ?>>Disponível</option>
                    <option value="lesionado" <?= ($jogador->getDisponivel() ?? '') === 'lesionado' ? 'selected' : '' ?>>Lesionado</option>
                    <option value="suspenso" <?= ($jogador->getDisponivel() ?? '') === 'suspenso' ? 'selected' : '' ?>>Suspenso</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><?= isset($jogador) && $jogador->getId() ? 'Atualizar' : 'Cadastrar' ?></button>
                <a href="<?= BASE_URL . '/jogadores' ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>
