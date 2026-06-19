<?php /** @var model\Tecnico $tecnico */ ?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/templates/template-head.php' ?>
    <title>Cadastro do Técnico</title>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .password-group {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 8px;
            top: 32px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }
        .error-msg {
            color: red;
            padding: 10px;
            background-color: #ffe6e6;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .button-group {
            margin-top: 20px;
        }
        .button-group button,
        .button-group a {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .button-group button {
            background-color: #4CAF50;
            color: white;
        }
        .button-group button:hover {
            background-color: #45a049;
        }
        .button-group a {
            background-color: #f44336;
            color: white;
        }
        .button-group a:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body class="container-fluid mt-4 ">

<h2 >Novo Técnico</h2>

<?php if (!empty($erro)) : ?>
    <div class="error-msg"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>


<form action="<?= BASE_URL ?>/tecnicos/cadastrar" method="POST" id="formTecnico">
    <input type="hidden" name="id" value="<?= isset($tecnico) ? htmlspecialchars($tecnico->getId() ?? '') : '' ?>">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input id="nome" name="nome" type="text"
               value="<?= isset($tecnico) ? htmlspecialchars($tecnico->getNome() ?? '') : '' ?>"               required placeholder="Nome completo">
    </div>

    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input id="cpf" name="cpf" type="text"
               value="<?= isset($tecnico) ? htmlspecialchars($tecnico->getCpf() ?? '') : '' ?>"
               placeholder="000.000.000-00"
               required
               maxlength="14">
        <small>Formato: XXX.XXX.XXX-XX</small>
    </div>

    <div class="form-group">
        <label for="email">E-mail:</label>
        <input id="email" name="email" type="email"
               value="<?= isset($tecnico) ? htmlspecialchars($tecnico->getEmail() ?? '') : '' ?>"
               required
               placeholder="usuario@email.com">
    </div>

    <div class="form-group">
        <label for="dataNascimento">Data de Nascimento:</label>
        <input id="dataNascimento" name="dataNascimento" type="date"
               value="<?= isset($tecnico) && $tecnico->getDataNascimento() ? $tecnico->getDataNascimento()->format('Y-m-d') : '' ?>"
               required>
    </div>

    <div class="form-group password-group">
        <label for="senha">Senha:</label>
        <input id="senha" name="senha" type="password"
               value="<?= htmlspecialchars($_POST['senha'] ?? '') ?? '' ?>"
            <?= isset($tecnico) && $tecnico->getId() ? '' : 'required' ?>
               placeholder="<?= isset($tecnico) && $tecnico->getId() ? '(deixar em branco para manter)' : '(mínimo 6 caracteres)' ?>">
        <button type="button" class="toggle-password" id="toggleSenha"></button>
        <small>
                Mínimo 6 caracteres
        </small>
    </div>

    <div class="button-group">
        <button type="submit">Salvar</button>
        <a href="<?= BASE_URL ?>/login">Cancelar</a>
    </div>
</form>


<?php require_once __DIR__ . "/templates/template-rodape.php" ?>
