<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - GIPE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f5f5f5; display: flex; align-items: center; height: 100vh; }</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">GIPE Login</h3>
                    
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>
                    
                    <?php if(session()->getFlashdata('success')):?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif;?>

                    <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="<?= base_url('auth/register') ?>" class="text-decoration-none">Criar uma conta nova</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>