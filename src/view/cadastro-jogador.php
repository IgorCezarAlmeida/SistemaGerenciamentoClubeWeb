<?php /**  @var model\Jogador $jogador ; */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once 'templates/template-head.php' ?>
    <title>Cadastro do Jogador</title>
</head>
<body class="container">
<?php require_once "templates/template-menu.php" ?>

<form action="<?= BASE_URL ?>/jogadores/cadastrar" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($jogador->getId() ?? '') ?>">

    <label for="nome">Nome:</label>
    <input id="nome" name="nome" type="text" required>
    <br>
    <label for="numeroCamisa">CPF:</label>
    <input id="numeroCamisa" name="numeroCamisa" type="number" required>
    <br>
    <label for="pesoKG">Peso:</label>
    <input id="pesoKG" name="pesoKG" type="number" required>
    <br>
    <label for="alturaCM">Altura:</label>
    <input id="alturaCM" name="alturaCM" type="number" required>
    <br>
    <label for="descricao">Descrição:</label>
    <input id="numeroCamisa" name="numeroCamisa" type="text" required>
    <br>
    <label for="disponivel">Situação:</label>
    <input id="disponivel" name="disponivel" type="text" required>
    <br>
    <label for="data_nascimento">Data de Nascimento</label>
    <input id="data_nascimento" name="data_nascimento" type="date" required>

    <button type="submit">Cadastrar</button>
</form>
<a href="<?= BASE_URL . '/jogadores'?>"Voltar</a>
<?php require_once "templates/template-rodape.php" ?>
</body>
</html>
