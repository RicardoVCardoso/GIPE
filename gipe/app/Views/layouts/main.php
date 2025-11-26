<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIPE | Experience</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            --text-primary: #1e293b;
            --accent: #6366f1;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-primary);
            background: linear-gradient(45deg, #EEF2FF, #E0E7FF, #C7D2FE);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Sidebar */
        .glass-sidebar {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-right: 1px solid var(--glass-border);
            width: 280px;
            height: 100vh;
            position: fixed;
            padding: 2rem 1rem;
            z-index: 1000;
            box-shadow: var(--glass-shadow);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(to right, #4f46e5, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 3rem;
            display: block;
            text-align: center;
            text-decoration: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #64748b;
            border-radius: 16px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: white;
            color: var(--accent);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
            transform: translateX(5px);
        }

        .nav-link i { width: 24px; margin-right: 12px; font-size: 1.1rem; }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem 3rem;
            transition: 0.3s;
        }

        /* Glass Cards */
        .card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            box-shadow: var(--glass-shadow);
            overflow: hidden;
        }

        .card-header {
            background: rgba(255, 255, 255, 0.4);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            padding: 1.5rem 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            border: none;
            border-radius: 12px;
            padding: 0.6rem 1.5rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: transform 0.2s;
        }
        
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4); }

        /* Table Styles */
        .table { --bs-table-bg: transparent; }
        thead th { 
            border-bottom: 2px solid rgba(99, 102, 241, 0.1) !important; 
            color: #64748b; 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            letter-spacing: 1px;
        }
        
        /* User Profile Badge */
        .user-badge {
            background: white;
            padding: 0.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.8);
        }
        .avatar-circle {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #f472b6, #a78bfa);
            border-radius: 50%;
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold;
        }

        @media (max-width: 991px) {
            .glass-sidebar { transform: translateX(-100%); }
            .glass-sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 1.5rem; }
        }
    </style>
</head>
<body>
<nav class="glass-sidebar" id="sidebar">
    <a href="/dashboard" class="brand-logo">GIPE</a>
    
    <div class="d-flex flex-column h-100">
        <div class="overflow-auto" style="max-height: calc(100vh - 200px);">
            
            <a href="/dashboard" class="nav-link <?= url_is('dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-grip"></i> Dashboard
            </a>
            
            <?php $tipo = session()->get('tipo'); ?>

            <?php if($tipo === 'admin'): ?>
                <div class="mt-4 mb-2 px-3 text-uppercase small fw-bold text-muted opacity-75">Administração Global</div>
                <a href="/utilizadores" class="nav-link <?= url_is('utilizadores*') ? 'active' : '' ?>"><i class="fa-solid fa-users-gear"></i> Gerir Utilizadores</a>
                <a href="/condominios" class="nav-link <?= url_is('condominios*') ? 'active' : '' ?>"><i class="fa-solid fa-city"></i> Todos os Condomínios</a>
            <?php endif; ?>

            <?php if($tipo === 'admin' || $tipo === 'gestor'): ?>
                <div class="mt-4 mb-2 px-3 text-uppercase small fw-bold text-muted opacity-75">Gestão</div>
                <?php if($tipo === 'gestor'): ?>
                    <a href="/condominios" class="nav-link <?= url_is('condominios*') ? 'active' : '' ?>"><i class="fa-regular fa-building"></i> Meus Condomínios</a>
                <?php endif; ?>
                <a href="/unidades" class="nav-link <?= url_is('unidades*') ? 'active' : '' ?>"><i class="fa-solid fa-key"></i> Unidades</a>
                <a href="/quartos" class="nav-link <?= url_is('quartos*') ? 'active' : '' ?>"><i class="fa-solid fa-bed"></i> Quartos</a>

                <div class="mt-4 mb-2 px-3 text-uppercase small fw-bold text-muted opacity-75">Financeiro</div>
                <a href="/despesas" class="nav-link <?= url_is('despesas*') ? 'active' : '' ?>"><i class="fa-solid fa-wallet"></i> Despesas</a>
                <a href="/receitas" class="nav-link <?= url_is('receitas*') ? 'active' : '' ?>"><i class="fa-solid fa-piggy-bank"></i> Receitas</a>
                <a href="/pagamentos" class="nav-link <?= url_is('pagamentos*') ? 'active' : '' ?>"><i class="fa-solid fa-file-invoice-dollar"></i> Pagamentos</a>
            <?php endif; ?>

            <div class="mt-4 mb-2 px-3 text-uppercase small fw-bold text-muted opacity-75">Dia a Dia</div>
            <a href="/ocorrencias" class="nav-link <?= url_is('ocorrencias*') ? 'active' : '' ?>"><i class="fa-solid fa-bolt"></i> Ocorrências</a>
            <a href="/comunicados" class="nav-link <?= url_is('comunicados*') ? 'active' : '' ?>"><i class="fa-solid fa-bullhorn"></i> Comunicados</a>
            <a href="/reservas" class="nav-link <?= url_is('reservas*') ? 'active' : '' ?>"><i class="fa-regular fa-calendar-check"></i> Reservas</a>
            <a href="/servicos" class="nav-link <?= url_is('servicos*') ? 'active' : '' ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Serviços</a>

        </div>

        <div class="mt-auto pt-4 border-top border-light">
            <a href="/auth/logout" class="nav-link text-danger">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
            </a>
        </div>
    </div>
</nav>
        <div class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-light d-lg-none rounded-circle shadow-sm" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            
            <div>
                <h2 class="fw-bold mb-0"><?= isset($title) ? $title : 'Visão Geral' ?></h2>
                <p class="text-muted mb-0 small">Bem-vindo ao futuro da gestão.</p>
            </div>

            <div class="dropdown">
                <div class="user-badge" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-end me-3 d-none d-md-block">
                        <div class="fw-bold small"><?= session()->get('nome') ?></div>
                        <div class="text-muted" style="font-size: 0.7rem;"><?= ucfirst(session()->get('tipo')) ?></div>
                    </div>
                    <div class="avatar-circle">
                        <?= strtoupper(substr(session()->get('nome'), 0, 1)) ?>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2 p-2" style="min-width: 200px;">
                    <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('profile') ?>"><i class="fa-regular fa-user me-2"></i> Meu Perfil</a></li>
                    <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="fa-solid fa-gear me-2"></i> Configurações</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded-3 py-2 text-danger" href="/auth/logout"><i class="fa-solid fa-power-off me-2"></i> Terminar Sessão</a></li>
                </ul>
            </div>
        </header>

        <?php if(session()->getFlashdata('success')): ?>
            <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({
                icon: 'success', 
                title: 'Ótimo!', 
                text: '<?= session()->getFlashdata('success') ?>', 
                background: 'rgba(255, 255, 255, 0.95)',
                confirmButtonColor: '#4f46e5'
            }));</script>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({
                icon: 'error', 
                title: 'Oops...', 
                text: '<?= session()->getFlashdata('error') ?>',
                background: 'rgba(255, 255, 255, 0.95)'
            }));</script>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Mobile Toggle
        $('#sidebarToggle').click(() => $('.glass-sidebar').toggleClass('active'));

        // DataTables Modern Config
        $(document).ready(function() {
            $('.datatable').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-PT.json' },
                dom: '<"d-flex justify-content-between align-items-center mb-4"f>rt<"d-flex justify-content-between align-items-center mt-4"ip>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass('form-control shadow-sm border-0 p-2 px-3').attr('placeholder', 'Pesquisar registos...');
                }
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>