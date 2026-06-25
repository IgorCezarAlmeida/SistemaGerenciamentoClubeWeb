<?php
/** @var Treino[] $treinos */
use model\Treino;

$rota_treinos = BASE_URL . "/treinos";
$sucesso = $_SESSION['sucesso'] ?? null;
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Lista de Treinos</title>

<?php require_once __DIR__ . '/templates/template-menu.php' ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Listagem de Treinos</h1>
        <a class="btn btn-primary" href="<?= BASE_URL . '/treinos/novo' ?>">Novo Treino</a>
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
                    <th>Intensidade</th>
                    <th>Clima</th>
                    <th>Descrição</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($treinos)) : ?>
                    <?php foreach ($treinos as $treino) : ?>
                        <tr>
                            <td><?= htmlspecialchars($treino->getId()) ?></td>
                            <td><?= htmlspecialchars($treino->getFocoTatico() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($treino->getIntensidade() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($treino->getClima() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars(substr($treino->getDescricao() ?? '', 0, 50)) ?></td>
                            <td>
                                <a href="<?= $rota_treinos . '/' . $treino->getId() . '/editar' ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= $rota_treinos . '/' . $treino->getId() ?>" class="btn btn-sm btn-info">Visualizar</a>
                                <form action="<?= $rota_treinos . '/' . $treino->getId() . '/remover' ?>" method='POST' style="display:inline;">
                                    <button type='submit' class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum treino cadastrado</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require_once __DIR__ . '/templates/template-layout-close.php' ?>


