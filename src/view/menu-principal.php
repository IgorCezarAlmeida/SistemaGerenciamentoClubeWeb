<?php
$dadosDashboard = $dadosDashboard ?? [];
$nomeTime = $dadosDashboard['nome_time'] ?? 'Meu Time';
$totalJogadores = $dadosDashboard['total_jogadores'] ?? 0;
$jogadoresDisponiveis = $dadosDashboard['jogadores_disponiveis'] ?? 0;
$jogadoresLesionados = $dadosDashboard['jogadores_lesionados'] ?? 0;
$tecnicoNome = $dadosDashboard['tecnico_nome'] ?? 'Técnico';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tactical Pro - Dashboard</title>
    <?php require_once __DIR__ . '/templates/template-head.php' ?>
    <STYLE>
        body {
            background-color: #e5e7eb; /* Fundo cinza claro da imagem */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            /* Menu Lateral */
            .sidebar {
            background-color: #111827; /* Fundo escuro */
            min-height: 100vh;
            color: #fff;
            border-right: 2px solid #000;
            }

            .sidebar .nav-link {
            color: #9ca3af;
            margin-bottom: 5px;
            padding: 10px 15px;
            font-weight: 500;
            }

            .sidebar .nav-link:hover {
            color: #fff;
            }

            /* Botão Laranja Ativo do Menu */
            .sidebar .nav-link.active {
            background-color: #f97316; /* Laranja Tactical Pro */
            color: #fff;
            border-radius: 6px;
            box-shadow: 3px 3px 0px #000; /* Sombra sólida no botão */
            }

            /* Estilo "Neobrutalista" dos Cards */
            .neo-card {
            background-color: #fff;
            border: 2px solid #111827;
            border-radius: 0px; /* Cantos retos na imagem original parecem ter raio mínimo ou nulo */
            box-shadow: 6px 6px 0px #111827; /* Sombra sólida deslocada */
            margin-bottom: 20px;
            }

            .neo-card-green {
            background-color: #ecfdf5; /* Fundo levemente verde */
            }

            .neo-card-red {
            background-color: #fef2f2; /* Fundo levemente vermelho */
            }

            .neo-card-dark {
            background-color: #111827;
            color: #fff;
            }
    </style>
<body>

<div class="d-flex">
    <?php require_once __DIR__ . '/templates/template-menu.php' ?>

    <div class="flex-grow-1">

        <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-dark">
            <h3 class="fst-italic m-0">VISÃO GERAL</h3>
            <div class="d-flex align-items-center">
                <div class="text-end me-2">
                    <small class="text-muted d-block" style="font-size: 0.7rem;">TÉCNICO LOGADO</small>
                    <strong>tecnico</strong>
                </div>
                <div class="bg-warning text-dark p-2 fw-bold" style="border: 2px solid #000; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">T</div>
            </div>
        </div>

        <div class="p-4">

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card neo-card p-3 h-100">
                        <div class="d-flex justify-content-between text-muted mb-2">
                            <small class="fw-bold">TOTAL DE JOGADORES</small>
                            <i class="bi bi-people"></i>
                        </div>
                        <h2 class="fw-bold m-0 text-dark">0</h2> </div>
                </div>
                <div class="col-md-4">
                    <div class="card neo-card neo-card-green p-3 h-100">
                        <div class="d-flex justify-content-between text-success mb-2">
                            <small class="fw-bold text-muted">DISPONÍVEIS</small>
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h2 class="fw-bold m-0 text-success">0</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card neo-card neo-card-red p-3 h-100">
                        <div class="d-flex justify-content-between text-danger mb-2">
                            <small class="fw-bold text-muted">NO DEPARTAMENTO MÉDICO</small>
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <h2 class="fw-bold m-0 text-danger">0</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card neo-card p-4 h-100">
                        <h5 class="fw-bold mb-4"><i class="bi bi-card-list"></i> Últimas Atividades</h5>

                        <div class="d-flex border-bottom pb-3 mb-3">
                            <span class="text-muted me-3" style="min-width: 120px;">Hoje, 14:30</span>
                            <span class="fw-bold text-dark">Sessão de treino tático registrada</span>
                        </div>
                        <div class="d-flex border-bottom pb-3 mb-3">
                            <span class="text-muted me-3" style="min-width: 120px;">Ontem, 18:00</span>
                            <span class="fw-bold text-dark">Escalação para o clássico definida</span>
                        </div>
                        <div class="d-flex">
                            <span class="text-muted me-3" style="min-width: 120px;">08 Mar, 10:00</span>
                            <span class="fw-bold text-dark">Novo jogador cadastrado: Marcos Silva</span>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card neo-card neo-card-dark p-4 h-100 text-center">
                        <h5 class="fw-bold text-warning text-start mb-4"><i class="bi bi-shield"></i> Próximo Jogo</h5>
                        <small class="text-muted mb-3 d-block">CAMPEONATO NACIONAL</small>

                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <div class="text-center">
                                <div class="rounded-circle border border-2 border-secondary d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                    <i class="bi bi-shield text-white fs-3"></i>
                                </div>
                                <small class="fw-bold">MEU TIME</small>
                            </div>
                            <div class="mx-3 fw-bold fst-italic">VS</div>
                            <div class="text-center">
                                <div class="rounded-circle border border-2 border-danger d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                    <i class="bi bi-shield text-danger fs-3"></i>
                                </div>
                                <small class="fw-bold">RIVAL FC</small>
                            </div>
                        </div>

                        <hr class="border-secondary">
                        <small class="text-light">Domingo, 16:00 • Estádio Municipal</small>
                    </div>
                </div>
            </div>

        </div>
</div>

<?php require_once __DIR__ . '/templates/template-rodape.php' ?>
</body>
</html>
