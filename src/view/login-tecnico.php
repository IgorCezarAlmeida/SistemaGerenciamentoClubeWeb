<?php
// $error pode ser definido pelo controller antes de incluir esta view
?>
<!doctype html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/templates/template-head.php' ?>
    <title>Tatical Pro - Login Técnico</title>


    <!-- Minimal custom styles - poucas cores -->
    <style>
        :root {
            --bg: #f5f7fa;
            --card: #ffffff;
            --accent: #000000; /* cor única de destaque */
            --muted: #6c757d;
        }
        html, body {
            height: 100%;
            background: var(--bg);
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }
        .login-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card-login {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(20,20,20,0.06);
            background: var(--card);
        }
        .card-header {
            background: var(--accent);
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 18px 20px;
        }
        .brand {
            font-weight: 700;
            letter-spacing: 0.3px;
            font-size: 1.2rem;
        }
        .brand-sub {
            font-weight: 500;
            font-size: 0.85rem;
            opacity: 0.9;
        }
        .card-body {
            padding: 22px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(43,108,176,0.12);
            border-color: var(--accent);
        }
        .btn-accent {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .btn-accent:hover {
            background: #ffdd40;
            border-color: #235a90;
        }
        .text-muted-small { color: var(--muted); font-size: 0.9rem; }
        .toggle-pass {
            cursor: pointer;
            color: var(--accent);
            font-weight: 600;
            font-size: 0.9rem;
            background: none;
            border: none;
        }
        @media (max-width: 420px) {
            .card-login { margin: 12px; }
        }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="card card-login">
        <div class="card-header d-flex flex-column align-items-start">
            <div class="brand login-icon"><i class="bi bi-shield"></i>Tatical Pro</div>
            <div class="brand-sub">Área de Login</div>
        </div>

        <div class="card-body">
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger small mb-3" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" method="post" action="<?= BASE_URL ?>/login" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label small">E-mail</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="seu.email@exemplo.com" required>
                    <div class="invalid-feedback">Informe um e-mail válido.</div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="senha" class="form-label small">Senha</label>
                    <div class="input-group">
                        <input id="senha" name="senha" type="password" class="form-control" placeholder="Senha" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePwd" title="Mostrar/ocultar senha">Mostrar</button>
                    </div>
                    <div class="form-text text-muted-small">Mínimo 6 caracteres</div>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Lembrar de mim</label>
                    </div>
                    <a href="#" class="small text-muted">Esqueceu a senha?</a>
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-accent">Entrar</button>
                </div>

                <div class="text-center">
                    <a href="<?= BASE_URL ?>/tecnicos/novo" class="small text-muted">Criar conta</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/templates/template-rodape.php" ?>
</body>
</html>
