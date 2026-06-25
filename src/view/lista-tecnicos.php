<?php
/** @var model\Tecnico[] $tecnicos */
use model\Tecnico;

$rota_tecnicos = BASE_URL . "/tecnicos";
$sucesso = $_SESSION['sucesso'] ?? null;
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Lista de Técnicos</title>

<?php require_once __DIR__ . '/templates/template-menu.php' ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0">Listagem de Técnicos</h1>
        <a class="btn btn-primary" href="<?= BASE_URL . '/tecnicos/novo' ?>">Novo Técnico</a>
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
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($tecnicos)) : ?>
                    <?php foreach ($tecnicos as $tecnico) : ?>
                        <tr>
                            <td><?= htmlspecialchars($tecnico->getId()) ?></td>
                            <td><?= htmlspecialchars($tecnico->getNome() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tecnico->getEmail() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tecnico->getCpf() ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($tecnico->getDataNascimento() ? $tecnico->getDataNascimento()->format('d/m/Y') : 'N/A') ?></td>
                            <td>
                                <a href="<?= $rota_tecnicos . '/' . $tecnico->getId() . '/editar' ?>" class="btn btn-sm btn-warning">Editar</a>
                                <form action="<?= $rota_tecnicos . '/' . $tecnico->getId() . '/remover' ?>" method='POST' style="display:inline;">
                                    <button type='submit' class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza? Esta ação é irreversível.')">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum técnico cadastrado</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php require_once __DIR__ . '/templates/template-layout-close.php' ?>


