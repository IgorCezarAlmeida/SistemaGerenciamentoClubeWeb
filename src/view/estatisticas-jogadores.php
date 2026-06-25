<?php
/** @var model\Estatisticas[] $estatisticas */
use model\Estatisticas;

$rota_estatisticas = BASE_URL . "/estatisticas";
$sucesso = $_SESSION['sucesso'] ?? null;
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Estatísticas de Jogadores</title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Estatísticas dos Jogadores</h1>
        <a class="btn btn-primary" href="<?= BASE_URL . '/estatisticas/novo' ?>">Nova Estatística</a>
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
                    <th>Gols</th>
                    <th>Assistências</th>
                    <th>Passes</th>
                    <th>Desarmes</th>
                    <th>Defesas</th>
                    <th>Minutos</th>
                    <th>Jogos</th>
                    <th>Cartões A.</th>
                    <th>Cartões V.</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($estatisticas)) : ?>
                    <?php foreach ($estatisticas as $est) : ?>
                        <tr>
                            <td><?= htmlspecialchars($est->getId()) ?></td>
                            <td><?= htmlspecialchars($est->getGols() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getAssistencias() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getPasses() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getDesarmes() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getDefesas() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getMinutosJogados() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getJogos() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getCartoesAmarelos() ?? 0) ?></td>
                            <td><?= htmlspecialchars($est->getCartoesVermelhos() ?? 0) ?></td>
                            <td>
                                <a href="<?= $rota_estatisticas . '/' . $est->getId() . '/editar' ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= $rota_estatisticas . '/' . $est->getId() ?>" class="btn btn-sm btn-info">Visualizar</a>
                                <form action="<?= $rota_estatisticas . '/' . $est->getId() . '/remover' ?>" method='POST' style="display:inline;">
                                    <button type='submit' class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="11" class="text-center">Nenhuma estatística cadastrada</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>


