<!DOCTYPE html>
<html lang="pt" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIPE | Experience</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            /* --- TEMA CLARO (Dia) --- */
            --bg-body: #f0f2f5;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #f3f4f6;
            
            --text-main: #111827;
            --text-muted: #6b7280;
            
            --accent-color: #6366f1;
            --accent-glow: rgba(99, 102, 241, 0.15);
            --border-color: #e5e7eb;
            
            --lamp-wire: #374151;
            --lamp-off: #d1d5db;
            --lamp-on: #fcd34d;
            --input-bg: #ffffff;
            --eyelid-color: #0f172a; /* Cor das pálpebras (sempre escura para o efeito dramático) */
        }

        [data-theme="dark"] {
            /* --- TEMA ESCURO (Noite) --- */
            --bg-body: #0f172a;
            --bg-sidebar: #1e293b;
            --bg-card: #1e293b;
            --bg-hover: #334155;
            
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            
            --accent-color: #818cf8;
            --accent-glow: rgba(129, 140, 248, 0.2);
            --border-color: #334155;
            
            --lamp-wire: #94a3b8;
            --lamp-off: #475569;
            --lamp-on: #fbbf24;
            --input-bg: #0f172a;
            /* --eyelid-color mantém-se igual para consistência na transição */
        }

        /* Removemos a transição lenta do body aqui, pois agora a pálpebra trata disso */
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            /* Transição mais rápida nos elementos para quando as pálpebras abrirem já estar tudo pronto */
            transition: background-color 0.1s, color 0.1s;
        }

        div, nav, button, input, select, textarea, span, i, h1, h2, h3, h4, h5, h6, p, td, th, a {
             transition: background-color 0.3s, color 0.3s, border-color 0.3s, box-shadow 0.3s;
        }

        /* --- ANIMAÇÃO PÁLPEBRAS (FECHAR OS OLHOS) --- */
        .eyelid {
            position: fixed;
            left: 0;
            width: 100%;
            height: 0;
            background-color: var(--eyelid-color);
            z-index: 99999; /* Acima de absolutamente tudo */
            /* Usamos uma curva bezier para um movimento mais orgânico (rápido no início, suave no fim) */
            transition: height 0.5s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            pointer-events: none; /* Permite clicar através delas quando abertas */
        }
        .eyelid-top { top: 0; }
        .eyelid-bottom { bottom: 0; }

        /* Classe adicionada via JS para fechar */
        body.eyes-closed .eyelid {
            height: 50.5vh; /* 50.5% para garantir que se encontram no meio sem folga */
            pointer-events: auto; /* Bloqueia a interação enquanto fechado */
        }

        /* Forçar Cores do Bootstrap */
        .text-dark { color: var(--text-main) !important; }
        .text-muted { color: var(--text-muted) !important; }
        .bg-white { background-color: var(--bg-card) !important; }
        .bg-light { background-color: var(--bg-body) !important; }
        
        /* Sidebar */
        .glass-sidebar {
            width: 280px; height: 100vh; position: fixed; top: 0; left: 0;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            z-index: 1000; padding: 2rem 1rem;
            display: flex; flex-direction: column;
        }

        .brand-logo {
            font-size: 2rem; font-weight: 800; letter-spacing: -1px;
            background: linear-gradient(to right, var(--accent-color), #ec4899);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center; margin-bottom: 2.5rem; text-decoration: none;
        }

        .nav-btn {
            width: 100%; display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 1.2rem; margin-bottom: 0.5rem;
            background: transparent; border: 1px solid transparent; border-radius: 14px;
            color: var(--text-muted); font-weight: 600; cursor: pointer; text-decoration: none;
        }
        
        .nav-btn:hover { background: var(--bg-hover); color: var(--text-main); }
        
        .nav-btn.active, .nav-btn[aria-expanded="true"] {
            background: var(--bg-body);
            color: var(--accent-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }
        
        .nav-btn i.icon-left { width: 24px; margin-right: 10px; font-size: 1.1rem; transition: 0.3s; }
        .nav-btn.active i.icon-left { transform: scale(1.2); text-shadow: 0 0 10px var(--accent-glow); }
        .nav-btn i.chevron { font-size: 0.8rem; transition: transform 0.4s; }
        .nav-btn[aria-expanded="true"] i.chevron { transform: rotate(180deg); }

        /* Submenus */
        .submenu {
            display: grid; grid-template-rows: 0fr; transition: grid-template-rows 0.4s ease;
            padding-left: 0.5rem;
        }
        .submenu.show { grid-template-rows: 1fr; margin-bottom: 0.5rem; }
        .submenu > div { overflow: hidden; }

        .sub-link {
            display: block; padding: 0.6rem 1rem; margin: 2px 0 2px 1rem;
            color: var(--text-muted); text-decoration: none; font-size: 0.9rem;
            border-left: 2px solid var(--border-color); border-radius: 0 8px 8px 0;
        }
        .sub-link:hover { background: var(--bg-hover); color: var(--text-main); padding-left: 1.2rem; }
        .sub-link.active { 
            color: var(--accent-color); 
            border-left-color: var(--accent-color); 
            background: var(--accent-glow); 
            font-weight: 600;
        }

        /* Main Content */
        .main-content { margin-left: 280px; padding: 2rem 3rem; }

        /* Cards */
        .card, .box {
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 20px; box-shadow: 0 4px 20px -5px rgba(0,0,0,0.1);
        }
        .card-header, .box-header { background: transparent; border-bottom: 1px solid var(--border-color); padding: 1.5rem; }
        
        /* Tables */
        .table { --bs-table-bg: transparent; color: var(--text-main); border-color: var(--border-color); }
        .table thead th { 
            background-color: var(--bg-hover); 
            color: var(--text-muted); 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            border-bottom: none;
        }
        .table-hover tbody tr:hover { background-color: var(--bg-hover); }

        /* Inputs */
        .form-control, .form-select {
            background-color: var(--input-bg); border: 1px solid var(--border-color); color: var(--text-main);
            padding: 0.8rem; border-radius: 12px;
        }
        .form-control:focus, .form-select:focus {
            background-color: var(--bg-card); color: var(--text-main);
            border-color: var(--accent-color); box-shadow: 0 0 0 4px var(--accent-glow);
        }
        ::placeholder { color: var(--text-muted) !important; opacity: 0.7; }
        
        /* Dropdowns */
        .dropdown-menu { background-color: var(--bg-card); border: 1px solid var(--border-color); }
        .dropdown-item { color: var(--text-main); }
        .dropdown-item:hover { background-color: var(--bg-hover); }

        /* --- CANDEEIRO ANIMADO --- */
        .lamp-container {
            position: absolute; 
            top: -100px; 
            right: 350px;
            z-index: 9990; /* Z-index alto, mas abaixo das pálpebras */
            display: flex; flex-direction: column; align-items: center; cursor: pointer;
            transition: top 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .lamp-container.visible { top: -20px; } 
        

        .lamp-wire { width: 2px; height: 60px; background-color: var(--lamp-wire); transition: 0.3s; }
        .lamp-bulb {
            width: 44px; height: 44px; background-color: var(--bg-card);
            border: 3px solid var(--lamp-wire); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 0 var(--lamp-light); transition: 0.3s;
        }
        .lamp-bulb i { font-size: 1.2rem; color: var(--text-muted); transition: 0.3s; }

        [data-theme="dark"] .lamp-bulb {
            background-color: var(--lamp-on); border-color: var(--lamp-on);
            box-shadow: 0 0 40px 10px rgba(251, 191, 36, 0.5);
        }
        [data-theme="dark"] .lamp-bulb i { color: #fff; }

        @media (max-width: 991px) {
            .glass-sidebar { transform: translateX(-100%); }
            .glass-sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 1.5rem; }
            .lamp-container { right: 20px; }
        }
    </style>
</head>
<body>

    <div class="eyelid eyelid-top"></div>
    <div class="eyelid eyelid-bottom"></div>

    <div class="lamp-container" id="themeLamp" title="Puxar para mudar o tema">
        <div class="lamp-wire"></div>
        <div class="lamp-bulb"><i class="fa-solid fa-lightbulb"></i></div>
    </div>

    <nav class="glass-sidebar" id="sidebar">
        <a href="/dashboard" class="brand-logo">GIPE</a>
        
        <div class="d-flex flex-column flex-grow-1 overflow-auto pe-1">
            <div class="px-3 mb-2 text-uppercase small fw-bold text-muted opacity-50">Navegação</div>
            
            <a href="/dashboard" class="nav-btn <?= url_is('dashboard') ? 'active' : '' ?>">
                <span><i class="fa-solid fa-grip-vertical icon-left"></i> Dashboard</span>
            </a>

            <?php $tipo = session()->get('tipo'); ?>

            <?php if($tipo === 'admin'): ?>
                <button class="nav-btn" onclick="toggleMenu('menuAdmin')">
                    <span><i class="fa-solid fa-user-shield icon-left"></i> Administração</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <div id="menuAdmin" class="submenu <?= url_is('utilizadores*') || url_is('gestores*') ? 'show' : '' ?>">
                    <div>
                        <a href="/utilizadores" class="sub-link <?= url_is('utilizadores*') ? 'active' : '' ?>">Utilizadores</a>
                        <a href="/gestores" class="sub-link <?= url_is('gestores*') ? 'active' : '' ?>">Gestores</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($tipo === 'admin' || $tipo === 'gestor'): ?>
                <button class="nav-btn" onclick="toggleMenu('menuImoveis')">
                    <span><i class="fa-solid fa-building-columns icon-left"></i> Propriedades</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <div id="menuImoveis" class="submenu <?= url_is('condominios*') || url_is('unidades*') || url_is('quartos*') ? 'show' : '' ?>">
                    <div>
                        <a href="/condominios" class="sub-link <?= url_is('condominios*') ? 'active' : '' ?>">Condomínios</a>
                        <a href="/unidades" class="sub-link <?= url_is('unidades*') ? 'active' : '' ?>">Unidades</a>
                        <a href="/quartos" class="sub-link <?= url_is('quartos*') ? 'active' : '' ?>">Quartos</a>
                    </div>
                </div>

                <button class="nav-btn" onclick="toggleMenu('menuFinancas')">
                    <span><i class="fa-solid fa-wallet icon-left"></i> Financeiro</span>
                    <i class="fa-solid fa-chevron-down chevron"></i>
                </button>
                <div id="menuFinancas" class="submenu <?= url_is('despesas*') || url_is('receitas*') || url_is('pagamentos*') ? 'show' : '' ?>">
                    <div>
                        <a href="/despesas" class="sub-link <?= url_is('despesas*') ? 'active' : '' ?>">Despesas</a>
                        <a href="/receitas" class="sub-link <?= url_is('receitas*') ? 'active' : '' ?>">Receitas</a>
                        <a href="/pagamentos" class="sub-link <?= url_is('pagamentos*') ? 'active' : '' ?>">Pagamentos</a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mt-4 px-3 mb-2 text-uppercase small fw-bold text-muted opacity-50">Dia a Dia</div>
            
            <button class="nav-btn" onclick="toggleMenu('menuComunidade')">
                <span><i class="fa-solid fa-users-rays icon-left"></i> Comunidade</span>
                <i class="fa-solid fa-chevron-down chevron"></i>
            </button>
            <div id="menuComunidade" class="submenu <?= url_is('ocorrencias*') || url_is('comunicados*') || url_is('reservas*') || url_is('servicos*') || url_is('obras*') ? 'show' : '' ?>">
                <div>
                    <a href="/ocorrencias" class="sub-link <?= url_is('ocorrencias*') ? 'active' : '' ?>">Ocorrências</a>
                    <a href="/comunicados" class="sub-link <?= url_is('comunicados*') ? 'active' : '' ?>">Comunicados</a>
                    <a href="/reservas" class="sub-link <?= url_is('reservas*') ? 'active' : '' ?>">Reservas</a>
                    <a href="/servicos" class="sub-link <?= url_is('servicos*') ? 'active' : '' ?>">Serviços</a>
                    <a href="/obras" class="sub-link <?= url_is('obras*') ? 'active' : '' ?>">Obras</a>
                </div>
            </div>
        </div>

        <div class="mt-3 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center">
            <div class="rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" 
                 style="width: 40px; height: 40px; background: var(--accent-color); font-weight: bold;">
                <?= strtoupper(substr(session()->get('nome'), 0, 1)) ?>
            </div>
            <div class="ms-3 overflow-hidden flex-grow-1">
                <div class="fw-bold text-truncate" style="font-size: 0.9rem; color: var(--text-main)"><?= session()->get('nome') ?></div>
                <div class="text-muted small text-truncate" style="font-size: 0.75rem;"><?= ucfirst($tipo) ?></div>
            </div>
            <a href="/auth/logout" class="btn btn-sm btn-danger bg-opacity-10 text-danger border-0" title="Terminar Sessão"><i class="fa-solid fa-power-off"></i></a>
        </div>
    </nav>

    <main class="main-content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-light d-lg-none rounded-circle shadow-sm" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            
            <div>
                <h3 class="fw-bold mb-0" style="color: var(--text-main); letter-spacing: -0.5px;"><?= isset($title) ? $title : 'GIPE' ?></h3>
                <p class="text-muted mb-0 small"><i class="fa-regular fa-calendar me-2"></i><?= date('d \d\e F, Y') ?></p>
            </div>
            
            <div class="d-flex gap-3">
                <div class="dropdown">
                    <a href="#" class="btn btn-light shadow-sm border border-secondary border-opacity-10 rounded-circle" 
                       style="background: var(--bg-card); color: var(--text-main);" 
                       title="Perfil" data-bs-toggle="dropdown">
                       <i class="fa-solid fa-user-gear"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-2 mt-2">
                        <li><a class="dropdown-item rounded-2 mb-1" href="/profile"><i class="fa-regular fa-id-card me-2"></i> Meu Perfil</a></li>
                        <li><hr class="dropdown-divider opacity-25"></li>
                        <li><a class="dropdown-item rounded-2 text-danger" href="/auth/logout"><i class="fa-solid fa-power-off me-2"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <?php if(session()->getFlashdata('success')): ?>
            <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({icon: 'success', title: 'Sucesso', text: '<?= session()->getFlashdata('success') ?>', confirmButtonColor: 'var(--accent-color)', background: 'var(--bg-card)', color: 'var(--text-main)'}));</script>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <script>document.addEventListener('DOMContentLoaded', () => Swal.fire({icon: 'error', title: 'Atenção', text: '<?= session()->getFlashdata('error') ?>', confirmButtonColor: '#ef4444', background: 'var(--bg-card)', color: 'var(--text-main)'}));</script>
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
        $('#sidebarToggle').click(() => $('.glass-sidebar').toggleClass('active'));

        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const btn = menu.previousElementSibling;
            const isOpen = menu.classList.contains('show');

            document.querySelectorAll('.submenu').forEach(el => {
                if(el.id !== id) {
                    el.classList.remove('show');
                    el.previousElementSibling.setAttribute('aria-expanded', 'false');
                }
            });

            if (isOpen) {
                menu.classList.remove('show');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                menu.classList.add('show');
                btn.setAttribute('aria-expanded', 'true');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const activeSub = document.querySelector('.sub-link.active');
            if(activeSub) {
                const parent = activeSub.closest('.submenu');
                parent.classList.add('show');
                parent.previousElementSibling.setAttribute('aria-expanded', 'true');
            }
            // Animação de entrada do candeeiro
            setTimeout(() => {
                document.getElementById('themeLamp').classList.add('visible');
            }, 500);
        });

        // --- NOVA LÓGICA DO TEMA COM PÁLPEBRAS ---
        const lamp = document.getElementById('themeLamp');
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);

        lamp.addEventListener('click', () => {
            // 1. Animação do candeeiro (puxar)
            lamp.style.transform = 'translateY(20px)'; 
            setTimeout(() => lamp.style.transform = 'translateY(0)', 200);

            // 2. Fecha os olhos (ativa a classe no body)
            document.body.classList.add('eyes-closed');

            // 3. Espera as pálpebras fecharem (500ms) para trocar o tema
            setTimeout(() => {
                const current = html.getAttribute('data-theme');
                const newTheme = current === 'light' ? 'dark' : 'light';
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);

                // 4. Abre os olhos
                document.body.classList.remove('eyes-closed');
            }, 500); // Tempo igual à transição CSS das pálpebras
        });

        // DataTables
        $(document).ready(function() {
            $('.datatable').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-PT.json' },
                dom: '<"d-flex justify-content-between align-items-center mb-3"f>rt<"d-flex justify-content-between align-items-center mt-3"ip>'
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>