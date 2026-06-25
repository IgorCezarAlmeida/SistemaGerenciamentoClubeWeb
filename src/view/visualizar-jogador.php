<?php /**  @var model\Jogador $jogador ; */ ?>
<?php /**  @var model\Contrato $contrato ; */ ?>
<?php /**  @var model\Lesao $lesao ; */ ?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title><?= htmlspecialchars($jogador->getNome()) ?></title>

<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

    <div class="content-header">
        <h1 class="m-0"><?= htmlspecialchars($jogador->getNome()) ?></h1>
        <a href="<?= BASE_URL . '/jogadores' ?>" class="btn btn-secondary">Voltar</a>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card neo-card p-4">
                    <h5 class="fw-bold mb-3">Informações Pessoais</h5>
                    <p><strong>ID:</strong> <?= htmlspecialchars($jogador->getId()) ?></p>
                    <p><strong>Número Camisa:</strong> <?= htmlspecialchars($jogador->getNumeroCamisa() ?? 'N/A') ?></p>
                    <p><strong>Posição:</strong> <?= htmlspecialchars($jogador->getPosicao() ?? 'N/A') ?></p>
                    <p><strong>Peso:</strong> <?= htmlspecialchars($jogador->getPesoKG() ?? 'N/A') ?> kg</p>
                    <p><strong>Altura:</strong> <?= htmlspecialchars($jogador->getAlturaCM() ?? 'N/A') ?> cm</p>
                    <p><strong>Data Nascimento:</strong> <?= htmlspecialchars($jogador->getDataNascimento() ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card neo-card p-4">
                    <h5 class="fw-bold mb-3">Lesões</h5>
                    <?php if (!empty($jogador->getLesoes())) : ?>
                        <ul class="list-unstyled">
                            <?php foreach ($jogador->getLesoes() as $lesao) :  ?>
                                <li class="mb-2">
                                    <span class="badge bg-danger"><?= htmlspecialchars($lesao->getTipoLesao()) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="text-muted">Sem lesões</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (!empty($jogador->getContrato())) : ?>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card neo-card p-4">
                        <h5 class="fw-bold mb-3">Contratos</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Salário</th>
                                        <th>Tempo Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jogador->getContrato() as $contrato) :  ?>
                                        <tr>
                                            <td><?= htmlspecialchars($contrato->getSalario() ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($contrato->getTempoContrato() ?? 'N/A') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php require_once __DIR__ . "/templates/template-layout-close.php" ?>
