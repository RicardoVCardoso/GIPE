<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="box mb-4 border-0 text-white" style="background: linear-gradient(120deg, var(--accent-color), #ec4899); border-radius: 24px; padding: 2rem; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold text-white mb-1">Olá, <?= session()->get('nome') ?>!</h3>
            <p class="mb-0 opacity-75">Aqui está o resumo do que se passa no seu património.</p>
        </div>
        <div class="d-none d-md-block" style="font-size: 3rem; opacity: 0.3;">
            <i class="fa-solid fa-building-user"></i>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card h-100 p-4 d-flex flex-row align-items-center justify-content-between border-0">
            <div>
                <div class="text-secondary fw-bold small text-uppercase mb-1">Condomínios</div>
                <h2 class="fw-bold mb-0"><?= $total_condominios ?></h2>
            </div>
            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fa-regular fa-building fs-4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-4 d-flex flex-row align-items-center justify-content-between border-0">
            <div>
                <div class="text-secondary fw-bold small text-uppercase mb-1">Unidades</div>
                <h2 class="fw-bold mb-0"><?= $total_unidades ?></h2>
            </div>
            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-door-open fs-4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-4 d-flex flex-row align-items-center justify-content-between border-0">
            <div>
                <div class="text-secondary fw-bold small text-uppercase mb-1">Ocorrências</div>
                <h2 class="fw-bold mb-0 text-danger"><?= $ocorrencias_pendentes ?></h2>
            </div>
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-triangle-exclamation fs-4"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 p-4 d-flex flex-row align-items-center justify-content-between border-0">
            <div>
                <div class="text-secondary fw-bold small text-uppercase mb-1">Pessoas</div>
                <h2 class="fw-bold mb-0"><?= $total_users ?></h2>
            </div>
            <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                <i class="fa-solid fa-users fs-4"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card p-4 h-100 border-0">
            <h5 class="fw-bold mb-4">Distribuição de Unidades</h5>
            <div style="position: relative; height: 300px;">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100 border-0 overflow-hidden">
            <div class="p-4 border-bottom" style="border-color: var(--border-color) !important;">
                <h5 class="fw-bold mb-0">Acesso Rápido</h5>
            </div>
            <div class="list-group list-group-flush">
                <a href="/condominios/create" class="list-group-item list-group-item-action p-3 border-0 d-flex align-items-center gap-3" style="background:transparent; color:var(--text-primary)">
                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width:40px; height:40px"><i class="fa-solid fa-plus"></i></div>
                    <div>
                        <div class="fw-bold small">Novo Condomínio</div>
                        <div class="text-muted small">Registar Edifício</div>
                    </div>
                </a>
                <a href="/despesas/create" class="list-group-item list-group-item-action p-3 border-0 d-flex align-items-center gap-3" style="background:transparent; color:var(--text-primary)">
                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width:40px; height:40px"><i class="fa-solid fa-receipt"></i></div>
                    <div>
                        <div class="fw-bold small">Nova Despesa</div>
                        <div class="text-muted small">Registar Pagamento</div>
                    </div>
                </a>
                <a href="/comunicados/create" class="list-group-item list-group-item-action p-3 border-0 d-flex align-items-center gap-3" style="background:transparent; color:var(--text-primary)">
                    <div class="rounded-3 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width:40px; height:40px"><i class="fa-solid fa-bullhorn"></i></div>
                    <div>
                        <div class="fw-bold small">Novo Comunicado</div>
                        <div class="text-muted small">Avisar Moradores</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scripts') ?>
<script>
    const ctx = document.getElementById('mainChart').getContext('2d');
    
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? '#334155' : '#e2e8f0';

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($tipos_unidades, 'tipo')) ?>,
            datasets: [{
                label: 'Unidades',
                data: <?= json_encode(array_column($tipos_unidades, 'total')) ?>,
                backgroundColor: ['#6366f1', '#10b981', '#f59e0b'],
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor } },
                x: { grid: { display: false }, ticks: { color: textColor } }
            }
        }
    });
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>