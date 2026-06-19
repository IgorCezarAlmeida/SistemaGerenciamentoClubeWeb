<?php /**  @var model\Jogador $jogador ; */ ?>
<?php /**  @var model\Contrato $contrato ; */ ?>
<?php /**  @var model\Lesao $lesao ; */ ?>
<!doctype html>
<html lang="en">
<head>
    <?php require_once __DIR__ . '/templates/template-head.php'?>
    <title><?= $jogador->getNome() ?></title>
</head>
<body class="container">
<?php require_once __DIR__ . "/templates/template-menu.php" ?>

<h1><?= $jogador->getId() ?></h1>
<h2><?= $jogador->getNome() ?></h2>
<h3><?= $jogador->getNumeroCamisa() ?></h3>
<h4><?= $jogador->getPesoKG() ?></h4>
<h5><?= $jogador->getAlturaCM() ?></h5>
<h6><?= $jogador->getDataNascimento() ?></h6>
<h7><?= $jogador->getPosicao() ?></h7>

<ul>
    <?php foreach ($jogador->getLesoes() as $lesao) :  ?>
        <li><?= $lesao->getTipoLesao() ?></li>
    <?php endforeach; ?>
    <?php foreach ($jogador->getContrato() as $contrato) :  ?>
        <li><?= $contrato->getSalario() ?></li>
        <li><?= $contrato->getTempoContrato() ?></li>
    <?php endforeach; ?>
</ul>
<?php require_once __DIR__ . "/templates/template-rodape.php" ?>
