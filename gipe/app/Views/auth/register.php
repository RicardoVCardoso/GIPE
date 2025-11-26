<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registar - GIPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f5f5f5; padding-top: 40px; }</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Criar Conta GIPE</h3>
                    
                    <?php if(isset($validation)):?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif;?>

                    <form action="<?= base_url('auth/attemptRegister') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" name="nome" class="form-control" value="<?= set_value('nome') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmar Senha</label>
                                <input type="password" name="confirma_senha" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Tipo de Conta</label>
                            <select name="tipo" class="form-select">
                                <option value="morador" <?= set_select('tipo', 'morador', true) ?>>Morador</option>
                                <option value="administrador" <?= set_select('tipo', 'administrador') ?>>Administrador</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Registar</button>
                        </div>
                    </form>
                    <hr>
                    <p class="text-center">Já tem conta? <a href="<?= base_url('auth/login') ?>">Entrar aqui</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>