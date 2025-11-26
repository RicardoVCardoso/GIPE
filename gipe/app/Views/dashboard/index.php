<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h2 class="fw-bold text-dark">Bem-vindo, <?= session()->get('nome') ?>!</h2>
    <p class="text-muted">Aqui está o resumo do seu património hoje.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="card-dashboard p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fw-bold small text-uppercase mb-1">Total Condomínios</p>
                    <h2 class="fw-bold mb-0 text-dark"><?= $total_condominios ?></h2>
                </div>
                <div class="icon-box bg-gradient-primary text-white shadow-sm">
                    <i class="fa-regular fa-building"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card-dashboard p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fw-bold small text-uppercase mb-1">Unidades Geridas</p>
                    <h2 class="fw-bold mb-0 text-dark"><?= $total_unidades ?></h2>
                </div>
                <div class="icon-box bg-gradient-success text-white shadow-sm">
                    <i class="fa-solid fa-key"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card-dashboard p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fw-bold small text-uppercase mb-1">Ocorrências Ativas</p>
                    <h2 class="fw-bold mb-0 text-danger"><?= $ocorrencias_pendentes ?></h2>
                </div>
                <div class="icon-box bg-gradient-danger text-white shadow-sm">
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card-dashboard p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted fw-bold small text-uppercase mb-1">Total Utilizadores</p>
                    <h2 class="fw-bold mb-0 text-dark"><?= $total_users ?></h2>
                </div>
                <div class="icon-box bg-gradient-warning text-white shadow-sm">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-dashboard p-4 h-100">
            <h5 class="fw-bold mb-4">Distribuição de Unidades</h5>
            <div style="height: 300px;">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-dashboard p-0 h-100 overflow-hidden">
            <div class="p-4 border-bottom bg-light">
                <h5 class="fw-bold mb-0">Acesso Rápido</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="/condominios/create" class="list-group-item list-group-item-action p-3 d-flex align-items-center border-0">
                    <div class="icon-box bg-light text-primary me-3" style="width:36px; height:36px; font-size:1rem"><i class="fa-solid fa-plus"></i></div>
                    <div>
                        <div class="fw-bold text-dark">Novo Condomínio</div>
                        <small class="text-muted">Registar novo empreendimento</small>
                    </div>
                </a>
                <a href="/despesas/create" class="list-group-item list-group-item-action p-3 d-flex align-items-center border-0">
                    <div class="icon-box bg-light text-danger me-3" style="width:36px; height:36px; font-size:1rem"><i class="fa-solid fa-receipt"></i></div>
                    <div>
                        <div class="fw-bold text-dark">Lançar Despesa</div>
                        <small class="text-muted">Registar conta a pagar</small>
                    </div>
                </a>
                <a href="/comunicados/create" class="list-group-item list-group-item-action p-3 d-flex align-items-center border-0">
                    <div class="icon-box bg-light text-warning me-3" style="width:36px; height:36px; font-size:1rem"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div class="fw-bold text-dark">Novo Comunicado</div>
                        <small class="text-muted">Enviar aviso aos moradores</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    const ctx = document.getElementById('mainChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($tipos_unidades, 'tipo')) ?>,
            datasets: [{
                label: 'Quantidade de Unidades',
                data: <?= json_encode(array_column($tipos_unidades, 'total')) ?>,
                backgroundColor: ['#4f46e5', '#10b981', '#f59e0b'],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, grid: { display: false } }, x: { grid: { display: false } } }
        }
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>