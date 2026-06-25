<?php
/** @var Jogador[] $jogadores */
/** @var Jogador $jogador */

use model\Jogador;

$rota_jogadores = BASE_URL . "/jogadores";
$dadosDashboard = $dadosDashboard ?? null;
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Lista de Jogadores</title>

<?php require_once __DIR__ . '/templates/template-menu.php' ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

        <div class="content-header">
            <h1 class="m-0">Listagem de Jogadores</h1>
            <a class="btn btn-primary" href="<?= BASE_URL . '/jogadores/cadastrar' ?>">Cadastrar Jogador</a>
        </div>

        <div class="content-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Posição</th>
                        <th>Numero Camisa</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Perna Dominante</th>
                        <th>Descrição</th>
                        <th>Disponível</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($jogadores as $jogador) : ?>
                        <tr>
                            <td><?=$jogador->getId()?></td>
                            <td><?=$jogador->getNome()?></td>
                            <td><?=$jogador->getPosicao()?></td>
                            <td><?=$jogador->getNumeroCamisa()?></td>
                            <td><?=$jogador->getAlturaCM()?></td>
                            <td><?=$jogador->getPesoKG()?></td>
                            <td><?=$jogador->getPernaDominante()?></td>
                            <td><?=$jogador->getDescricao()?></td>
                            <td><?=$jogador->getDisponivel()?></td>
                        <td>
                            <a href="<?= $rota_jogadores . '/' . $jogador->getId() . '/editar' ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href='<?= $rota_jogadores . '/' . $jogador->getId() ?>' class="btn btn-sm btn-info">Visualizar</a>
                            <form action='<?= $rota_jogadores . '/' . $jogador->getId() . '/remover' ?>' method='POST' style="display:inline;">
                                <button type='submit' class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php require_once __DIR__ . '/templates/template-layout-close.php' ?>
