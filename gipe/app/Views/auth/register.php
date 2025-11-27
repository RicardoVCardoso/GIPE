<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registo | GIPE</title>
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
            height: 100vh; display: flex; align-items: center; justify-content: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 24px; padding: 2.5rem;
            width: 100%; max-width: 500px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37); z-index: 2;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2);
            color: white; padding: 0.8rem 1rem; padding-right: 50px; border-radius: 12px; transition: 0.3s;
            position: relative; z-index: 2;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15); border-color: #fff; color: white;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
        }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.6); }
        option { color: #333; }

        .btn-primary {
            background: white; color: #6366f1; font-weight: 800; border: none;
            padding: 0.9rem; border-radius: 12px; width: 100%; margin-top: 1rem;
            transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;
        }
        .btn-primary:hover { transform: translateY(-2px); background: #f8fafc; }

        .text-link { color: rgba(255, 255, 255, 0.8); text-decoration: none; }
        .text-link:hover { color: white; text-decoration: underline; }

        /* --- AMATERASU FIRE --- */
        .password-wrapper { position: relative; transition: 0.3s; }
        
        .password-wrapper.burning input {
            background-color: rgba(0,0,0,0.7) !important;
            border-color: #000 !important;
            color: #fff !important;
            box-shadow: inset 0 0 10px #000;
        }

        .password-wrapper.burning::before,
        .password-wrapper.burning::after {
            content: ""; position: absolute; top: -5px; left: -5px; right: -5px; bottom: -5px;
            background: transparent; border-radius: 16px; z-index: 0;
            box-shadow: 0 0 10px 2px #000, 0 -10px 20px 5px rgba(0,0,0,0.8);
            animation: amaterasuFlame 0.1s infinite alternate linear;
        }
        .password-wrapper.burning::after {
            filter: blur(4px); animation-duration: 0.15s; animation-direction: alternate-reverse; top: -10px; opacity: 0.7;
        }
        
        @keyframes amaterasuFlame {
            0% { transform: skewX(-2deg) translateY(0); }
            50% { transform: skewX(-1deg) translateY(1px); box-shadow: 0 0 15px 5px #000, 0 -15px 25px 8px #000; }
            100% { transform: skewX(2deg) translateY(-2px); }
        }

        /* --- EYE --- */
        .eye-container {
            position: absolute; top: 50%; right: 15px; transform: translateY(-50%);
            width: 24px; height: 20px; cursor: pointer; overflow: hidden;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; z-index: 10;
        }
        .eye-ball {
            font-size: 1.1rem; color: var(--eye-ball); opacity: 0; transform: scale(0.8);
            transition: opacity 0.5s, transform 2s;
        }
        .eye-lid {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-color: var(--eye-lid); border-radius: 5px; transform-origin: top;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex; align-items: center; justify-content: center;
        }
        .eye-lid::after { content: ''; width: 100%; height: 2px; background: rgba(255,255,255,0.5); position: absolute; top: 50%; }
        
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
        <div class="text-center mb-4">
            <h2 class="fw-bold text-white mb-1">Criar Conta</h2>
            <p class="text-white-50 small">Junte-se ao ecossistema GIPE</p>
        </div>

        <?php if(isset($validation)):?>
            <div class="alert alert-danger bg-danger bg-opacity-75 text-white border-0 mb-4 rounded-3 small">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif;?>

        <form action="<?= base_url('auth/attemptRegister') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="<?= set_value('nome') ?>" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="password-wrapper" id="regWrapper1">
                        <input type="password" name="senha" id="regPass" class="form-control" placeholder="Senha" required>
                        <div class="eye-container" onclick="triggerAmaterasu('regPass', 'regWrapper1', this)">
                            <i class="fa-solid fa-eye eye-ball"></i>
                            <div class="eye-lid"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="password-wrapper" id="regWrapper2">
                        <input type="password" name="confirma_senha" id="regConfirm" class="form-control" placeholder="Confirmar" required>
                        <div class="eye-container" onclick="triggerAmaterasu('regConfirm', 'regWrapper2', this)">
                            <i class="fa-solid fa-eye eye-ball"></i>
                            <div class="eye-lid"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <select name="tipo" class="form-select bg-transparent" required>
                    <option value="" selected disabled>Eu sou...</option>
                    <option value="morador">Morador / Inquilino</option>
                    <option value="gestor">Gestor de Condomínio</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registar</button>
        </form>

        <div class="text-center mt-4 text-white-50 small">
            Já tem conta? <a href="<?= base_url('auth/login') ?>" class="text-link fw-bold">Entrar</a>
        </div>
    </div>

    <script>
        function triggerAmaterasu(inputId, wrapperId, container) {
            const input = document.getElementById(inputId);
            const wrapper = document.getElementById(wrapperId);
            
            if (input.type === "password") {
                input.type = "text";
                container.classList.add('open');
                setTimeout(() => wrapper.classList.add('burning'), 100);
            } else {
                input.type = "password";
                container.classList.remove('open');
                wrapper.classList.remove('burning');
            }
        }
    </script>
</body>
</html>