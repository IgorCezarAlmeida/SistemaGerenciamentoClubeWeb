<?php
/** @var model\Escalacao[] $escalacoes */
use model\Escalacao;

$rota_escalacoes = BASE_URL . "/escalacoes";
$sucesso = $_SESSION['sucesso'] ?? null;
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Lista de Escalações</title>

<?php require_once __DIR__ . '/templates/template-menu.php' ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Listagem de Escalações</h1>
        <a class="btn btn-primary" href="<?= BASE_URL . '/escalacoes/novo' ?>">Nova Escalação</a>
    </div>

    <div class="content-body">
        <?php if (!empty($sucesso)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($sucesso) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($erro)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($erro) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Esquema Tático</th>
                    <th>Instruções Gerais</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($escalacoes)) : ?>
                    <?php foreach ($escalacoes as $escalacao) : ?>
                        <tr>
                            <td><?= htmlspecialchars($escalacao->getId()) ?></td>
                            <td><?= htmlspecialchars($escalacao->getEsquemaTatico() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars(substr($escalacao->getInstrucoesGerais() ?? '', 0, 50)) ?></td>
                            <td>
                                <a href="<?= $rota_escalacoes . '/' . $escalacao->getId() . '/editar' ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= $rota_escalacoes . '/' . $escalacao->getId() ?>" class="btn btn-sm btn-info">Visualizar</a>
                                <form action="<?= $rota_escalacoes . '/' . $escalacao->getId() . '/remover' ?>" method='POST' style="display:inline;">
                                    <button type='submit' class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma escalação cadastrada</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require_once __DIR__ . '/templates/template-layout-close.php' ?>


