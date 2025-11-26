<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 h-100 text-center p-5">
            <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle text-white shadow-lg" 
                 style="width: 120px; height: 120px; background: linear-gradient(135deg, #6366f1, #ec4899); font-size: 3rem;">
                <?= strtoupper(substr($user['nome'], 0, 1)) ?>
            </div>
            <h3 class="fw-bold"><?= esc($user['nome']) ?></h3>
            <p class="text-muted badge bg-light text-dark mx-auto mt-2 px-3 py-2 rounded-pill border"><?= ucfirst($user['tipo']) ?></p>
            <p class="mt-3 text-muted small">Membro desde: <?= date('d/m/Y', strtotime($user['data_registo'])) ?></p>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card border-0 h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold text-primary mb-0"><i class="fa-solid fa-user-pen me-2"></i> Editar Dados</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Nome Completo</label>
                            <input type="text" name="nome" class="form-control bg-light border-0 py-2" value="<?= esc($user['nome']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Email</label>
                            <input type="email" name="email" class="form-control bg-light border-0 py-2" value="<?= esc($user['email']) ?>" required>
                        </div>
                    </div>

                    <hr class="my-4 opacity-25">
                    <h6 class="fw-bold text-primary mb-3"><i class="fa-solid fa-lock me-2"></i> Segurança</h6>
                    <div class="alert alert-light border-0 shadow-sm small text-muted">
                        <i class="fa-solid fa-info-circle me-1"></i> Deixe os campos de senha vazios se não quiser alterá-la.
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Nova Senha</label>
                            <input type="password" name="senha" class="form-control bg-light border-0 py-2">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase text-muted">Confirmar Senha</label>
                            <input type="password" name="confirm_senha" class="form-control bg-light border-0 py-2">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>