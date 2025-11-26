<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIPE | Gestão Imobiliária</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --bg-light: #f8f9fa;
            --text-dark: #2b2d42;
            --sidebar-width: 260px;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-light); color: var(--text-dark); overflow-x: hidden; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            z-index: 1000;
            overflow-y: auto;
            transition: 0.3s;
        }
        .sidebar-brand { padding: 1.5rem; font-size: 1.5rem; font-weight: 800; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .nav-category { font-size: 0.75rem; text-transform: uppercase; color: #adb5bd; font-weight: 700; padding: 1rem 1.5rem 0.5rem; letter-spacing: 0.5px; }
        .nav-link {
            color: #6c757d; padding: 0.75rem 1.5rem; font-weight: 500; display: flex; align-items: center; gap: 12px; transition: 0.2s; border-left: 3px solid transparent;
        }
        .nav-link:hover, .nav-link.active { color: var(--primary); background: #f0f4ff; border-left-color: var(--primary); }
        .nav-link i { width: 20px; text-align: center; }

        /* Conteúdo */
        .main-content { margin-left: var(--sidebar-width); padding: 2rem; transition: 0.3s; }
        
        /* Cards & Tables */
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); background: #fff; }
        .card-header { background: transparent; border-bottom: 1px solid #f1f3f5; padding: 1.25rem; font-weight: 600; }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        
        /* Mobile */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="fa-solid fa-city"></i> GIPE
    </div>
    <div class="nav flex-column">
        <a href="/dashboard" class="nav-link <?= url_is('dashboard') ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
        </a>

        <div class="nav-category">Gestão Principal</div>
        <a href="/condominios" class="nav-link <?= url_is('condominios*') ? 'active' : '' ?>"><i class="fa-regular fa-building"></i> Condomínios</a>
        <a href="/unidades" class="nav-link <?= url_is('unidades*') ? 'active' : '' ?>"><i class="fa-solid fa-door-closed"></i> Unidades</a>
        <a href="/quartos" class="nav-link <?= url_is('quartos*') ? 'active' : '' ?>"><i class="fa-solid fa-bed"></i> Quartos</a>
        <a href="/utilizadores" class="nav-link <?= url_is('utilizadores*') ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Utilizadores</a>

        <div class="nav-category">Financeiro</div>
        <a href="/despesas" class="nav-link <?= url_is('despesas*') ? 'active' : '' ?>"><i class="fa-solid fa-arrow-trend-down"></i> Despesas</a>
        <a href="/receitas" class="nav-link <?= url_is('receitas*') ? 'active' : '' ?>"><i class="fa-solid fa-arrow-trend-up"></i> Receitas</a>
        <a href="/pagamentos" class="nav-link <?= url_is('pagamentos*') ? 'active' : '' ?>"><i class="fa-solid fa-credit-card"></i> Pagamentos</a>
        <a href="/historico_pagamentos" class="nav-link <?= url_is('historico*') ? 'active' : '' ?>"><i class="fa-solid fa-clock-rotate-left"></i> Histórico</a>

        <div class="nav-category">Operacional</div>
        <a href="/ocorrencias" class="nav-link <?= url_is('ocorrencias*') ? 'active' : '' ?>"><i class="fa-solid fa-triangle-exclamation"></i> Ocorrências</a>
        <a href="/reservas" class="nav-link <?= url_is('reservas*') ? 'active' : '' ?>"><i class="fa-regular fa-calendar-check"></i> Reservas</a>
        <a href="/obras" class="nav-link <?= url_is('obras*') ? 'active' : '' ?>"><i class="fa-solid fa-hammer"></i> Obras</a>
        <a href="/reunioes" class="nav-link <?= url_is('reunioes*') ? 'active' : '' ?>"><i class="fa-solid fa-handshake"></i> Reuniões</a>
        <a href="/comunicados" class="nav-link <?= url_is('comunicados*') ? 'active' : '' ?>"><i class="fa-solid fa-bullhorn"></i> Comunicados</a>

        <div class="nav-category">Serviços & Staff</div>
        <a href="/servicos" class="nav-link <?= url_is('servicos*') ? 'active' : '' ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Serviços</a>
        <a href="/prestadores" class="nav-link <?= url_is('prestadores*') ? 'active' : '' ?>"><i class="fa-solid fa-user-gear"></i> Prestadores</a>
        <a href="/gestores" class="nav-link <?= url_is('gestores*') ? 'active' : '' ?>"><i class="fa-solid fa-user-tie"></i> Gestores</a>

        <div class="nav-category">Sistema</div>
        <a href="/notificacoes" class="nav-link <?= url_is('notificacoes*') ? 'active' : '' ?>"><i class="fa-regular fa-bell"></i> Notificações</a>
        <a href="/avaliacoes" class="nav-link <?= url_is('avaliacoes*') ? 'active' : '' ?>"><i class="fa-regular fa-star"></i> Avaliações</a>
        <a href="/feedback" class="nav-link <?= url_is('feedback*') ? 'active' : '' ?>"><i class="fa-regular fa-comments"></i> Feedback</a>
        <a href="/anexos" class="nav-link <?= url_is('anexos*') ? 'active' : '' ?>"><i class="fa-solid fa-paperclip"></i> Anexos</a>
        
        <div class="mt-4 px-3 mb-4">
            <a href="/auth/logout" class="btn btn-danger w-100"><i class="fa-solid fa-power-off me-2"></i> Sair</a>
        </div>
    </div>
</nav>

<main class="main-content">
    <header class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-light d-lg-none shadow-sm" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
        <h4 class="fw-bold mb-0 text-dark"><?= isset($title) ? $title : 'GIPE Dashboard' ?></h4>
        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:35px; height:35px; font-weight:bold">
                        <?= strtoupper(substr(session()->get('nome'), 0, 1)) ?>
                    </div>
                    <span class="d-none d-md-block small fw-bold"><?= session()->get('nome') ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="/auth/logout">Sair</a></li>
                </ul>
            </div>
        </div>
    </header>

    <?php if(session()->getFlashdata('success')): ?>
        <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({icon: 'success', title: 'Sucesso', text: '<?= session()->getFlashdata('success') ?>', timer: 3000, showConfirmButton: false}));</script>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({icon: 'error', title: 'Erro', text: '<?= session()->getFlashdata('error') ?>'}));</script>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Toggle Sidebar Mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Init DataTables
    $(document).ready(function() {
        $('.datatable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-PT.json' },
            dom: '<"d-flex justify-content-between align-items-center mb-3"f>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
        });
    });
</script>
<?= $this->renderSection('scripts') ?>
</body>
</html>