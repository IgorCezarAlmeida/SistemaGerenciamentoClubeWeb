<?php
/** @var Jogador[] $jogadores */
/** @var Jogador $jogador */

use model\Jogador;

$rota_jogadores = BASE_URL . "/jogadores";
$dadosDashboard = $dadosDashboard ?? null;
?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/templates/template-head.php' ?>
    <title>Lista de Jogadores</title>
</head>
<body class="container">
<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<h1>Listagem de Jogadores</h1>
<a class="btn btn-primary" href="<?= BASE_URL . '/jogadores/cadastrar' ?>">Cadastrar Jogador</a>
<table>
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
            <a href="<?= $rota_jogadores . '/' . $jogador->getId() . '/editar' ?>">Editar</a>
            <a href='<?= $rota_jogadores . '/' . $jogador->getId() ?>'>Visualizar</a>
            <form action='<?= $rota_jogadores . '/' . $jogador->getId() . '/remover' ?>' method='POST'>
                <button type='submit'>Remover</button>
            </form>
        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require_once __DIR__ . "/templates/template-rodape.php" ?>
