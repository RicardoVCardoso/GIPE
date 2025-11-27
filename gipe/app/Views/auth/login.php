<!DOCTYPE html>
<html lang="pt">
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | GIPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --eye-lid: #94a3b8;
            --eye-ball: #ef4444;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 24px; padding: 3rem;
            width: 100%; max-width: 420px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            z-index: 2; /* Acima do fundo */
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2);
            color: white; padding: 0.8rem 1rem; padding-right: 50px; border-radius: 12px; transition: 0.3s;
            position: relative; z-index: 2;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15); border-color: #fff; color: white;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.6); }

        .btn-primary {
            background: white; color: #6366f1; font-weight: 800; border: none;
            padding: 0.9rem; border-radius: 12px; width: 100%; margin-top: 1rem;
            transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;
        }
        .btn-primary:hover {
            transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: #f8fafc; color: #4f46e5;
        }

        .text-link { color: rgba(255, 255, 255, 0.8); text-decoration: none; transition: 0.2s; }
        .text-link:hover { color: white; text-decoration: underline; }

        /* --- CONTAINER DE SENHA --- */
        .password-wrapper { position: relative; transition: 0.3s; }

        /* --- AMATERASU: EFEITO DE LABAREDAS NEGRAS --- */
        
        /* O input fica escuro quando arde */
        .password-wrapper.burning input {
            background-color: rgba(0,0,0,0.7) !important;
            border-color: #000 !important;
            color: #fff !important;
            box-shadow: inset 0 0 10px #000;
        }

        /* Camadas de Fogo (Pseudo-elementos no Wrapper) */
        .password-wrapper.burning::before,
        .password-wrapper.burning::after {
            content: "";
            position: absolute;
            top: -5px; left: -5px; right: -5px; bottom: -5px;
            background: transparent;
            border-radius: 16px;
            z-index: 0; /* Atrás do input */
            
            /* Sombra que simula fogo */
            box-shadow: 
                0 0 10px 2px #000, 
                0 -10px 20px 5px rgba(0,0,0,0.8), 
                0 -20px 30px 10px rgba(20, 0, 0, 0.5);
            
            /* Animação Caótica */
            animation: amaterasuFlame 0.1s infinite alternate linear;
        }

        .password-wrapper.burning::after {
            /* Segunda camada para mais caos */
            filter: blur(4px);
            animation-duration: 0.15s;
            animation-direction: alternate-reverse;
            top: -10px; /* Fogo sobe mais */
            opacity: 0.7;
        }

        @keyframes amaterasuFlame {
            0% { transform: skewX(-2deg) scale(1) translateY(0); }
            25% { transform: skewX(1deg) scale(1.02) translateY(-2px); }
            50% { transform: skewX(-1deg) scale(1.01) translateY(1px); box-shadow: 0 0 15px 5px #000, 0 -15px 25px 8px #000; }
            75% { transform: skewX(2deg) scale(1.03) translateY(-3px); }
            100% { transform: skewX(0deg) scale(1) translateY(0); }
        }

        /* --- OLHO ITACHI (Sempre visível) --- */
        .eye-container {
            position: absolute; top: 50%; right: 15px; transform: translateY(-50%);
            width: 24px; height: 20px; cursor: pointer; overflow: hidden;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10;
        }
        
        /* Olho (Fundo) */
        .eye-ball {
            font-size: 1.1rem; color: var(--eye-ball); opacity: 0; transform: scale(0.8);
            transition: opacity 0.5s ease, transform 2s ease; /* Abre lentamente */
        }

        /* Pálpebra (Frente) */
        .eye-lid {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-color: var(--eye-lid); border-radius: 5px; transform-origin: top;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1); /* Lento e dramático */
            display: flex; align-items: center; justify-content: center;
        }
        .eye-lid::after {
            content: ''; width: 100%; height: 2px; background: rgba(255,255,255,0.5); position: absolute; top: 50%;
        }

        /* Estado Aberto */
        .eye-container.open .eye-lid { transform: translateY(-130%); }
        .eye-container.open .eye-ball {
            opacity: 1; transform: scale(1.2); filter: drop-shadow(0 0 5px red);
            animation: eyePulse 0.1s infinite;
        }
        @keyframes eyePulse { 0% { filter: drop-shadow(0 0 3px red); } 100% { filter: drop-shadow(0 0 8px red); } }

    </style>
</head>
<body>
    <div class="glass-card">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-white mb-0" style="font-size: 2.5rem; letter-spacing: -1px;">
                <i class="fa-solid fa-building-shield me-2"></i>GIPE
            </h1>
            <p class="text-white-50 mt-1">Gestão Imobiliária de Património Empresarial</p>
        </div>

        <?php if(session()->getFlashdata('error')):?>
            <div class="alert alert-danger bg-danger bg-opacity-75 text-white border-0 mb-4 rounded-3 fade show">
                <i class="fa-solid fa-circle-exclamation me-2"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif;?>
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success bg-success bg-opacity-75 text-white border-0 mb-4 rounded-3 fade show">
                <i class="fa-solid fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif;?>

        <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="O seu email" value="<?= old('email') ?>" required>
            </div>

            <div class="mb-4 password-wrapper" id="loginWrapper">
                <input type="password" name="senha" id="loginPass" class="form-control" placeholder="A sua senha" required>
                
                <div class="eye-container" onclick="triggerAmaterasu('loginPass', 'loginWrapper', this)">
                    <i class="fa-solid fa-eye eye-ball"></i>
                    <div class="eye-lid"></div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        <div class="text-center mt-4 text-white-50 small">
            Ainda não tem conta? <a href="<?= base_url('auth/register') ?>" class="text-link fw-bold">Registe-se aqui</a>
        </div>
    </div>

    <script>
        function triggerAmaterasu(inputId, wrapperId, container) {
            const input = document.getElementById(inputId);
            const wrapper = document.getElementById(wrapperId);
            
            if (input.type === "password") {
                // ATIVAR AMATERASU
                input.type = "text";
                
                // 1. Olho abre (Lento)
                container.classList.add('open');
                
                // 2. Fogo explode (Rápido)
                // Pequeno delay para sincronizar com o início da abertura do olho
                setTimeout(() => {
                    wrapper.classList.add('burning');
                }, 100);
                
            } else {
                // DESATIVAR
                input.type = "password";
                container.classList.remove('open');
                wrapper.classList.remove('burning');
            }
        }
    </script>
</body>
</html>