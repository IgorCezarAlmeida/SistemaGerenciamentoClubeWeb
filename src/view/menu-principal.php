<?php
$dadosDashboard = $dadosDashboard ?? [];
$nomeTime = $dadosDashboard['nome_time'] ?? 'Meu Time';
$totalJogadores = $dadosDashboard['total_jogadores'] ?? 0;
$jogadoresDisponiveis = $dadosDashboard['jogadores_disponiveis'] ?? 0;
$jogadoresLesionados = $dadosDashboard['jogadores_lesionados'] ?? 0;
$tecnicoNome = $dadosDashboard['tecnico_nome'] ?? 'Técnico';
?>
<?php require_once __DIR__ . '/templates/template-layout-open.php' ?>
<title>Tactical Pro - Dashboard</title>

<?php require_once __DIR__ . '/templates/template-menu.php' ?>

<?php require_once __DIR__ . '/templates/template-content-open.php' ?>

        <div class="content-header">
            <h3 class="fst-italic m-0">VISÃO GERAL</h3>
            <div class="d-flex align-items-center">
                <div class="text-end me-2">
                    <small class="text-muted d-block" style="font-size: 0.7rem;">TÉCNICO LOGADO</small>
                    <strong><?php echo htmlspecialchars($tecnicoNome); ?></strong>
                </div>
                <div class="bg-warning text-dark p-2 fw-bold" style="border: 2px solid #000; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"><?php echo strtoupper(substr($tecnicoNome, 0, 1)); ?></div>
            </div>
        </div>

        <div class="content-body">

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
                        <h2 class="fw-bold m-0 text-danger"><?= $jogadoresLesionados ?></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card neo-card p-4 h-100">
                        <h5 class="fw-bold mb-4"><i class="bi bi-card-list"></i> Últimas Atividades</h5>

                        <?php
                        use utils\AtividadeHelper;
                        $atividades = AtividadeHelper::obterAtividades(5);

                        if (empty($atividades)): ?>
                            <p class="text-muted">Nenhuma atividade registrada</p>
                        <?php else:
                            foreach ($atividades as $atividade): ?>
                                <div class="d-flex border-bottom pb-3 mb-3">
                                    <span class="text-muted me-3" style="min-width: 120px;"><?= AtividadeHelper::formatarData($atividade['data']) ?></span>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($atividade['descricao']) ?></span>
                                </div>
                            <?php endforeach;
                        endif; ?>

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

<?php require_once __DIR__ . '/templates/template-layout-close.php' ?>
