<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h5 class="m-0 fw-bold text-primary"><?= $title ?></h5>
            </div>
            <div class="card-body p-4">
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger rounded-3 small border-0 bg-danger bg-opacity-10 text-danger">
                        <?php foreach ($errors as $error): ?>
                            <p class="mb-0"><i class="fa-solid fa-circle-exclamation me-2"></i> <?= esc($error) ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('condominios/' . $action) ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Nome do Condomínio</label>
                        <input type="text" name="nome" class="form-control" value="<?= esc($condominio['nome'] ?? '') ?>" required placeholder="Ex: Edifício Panorama">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small text-uppercase">Endereço Completo</label>
                        <input type="text" name="endereco" class="form-control" value="<?= esc($condominio['endereco'] ?? '') ?>" required placeholder="Rua, Número, Cidade">
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">Telefone</label>
                            <input type="text" name="telefone" class="form-control" value="<?= esc($condominio['telefone'] ?? '') ?>" placeholder="+351 ...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">Admin Responsável</label>
                            <select name="administrador_id" class="form-select">
                                <option value="">-- Selecione um Admin --</option>
                                <?php foreach($admins as $admin): ?>
                                    <option value="<?= $admin['id'] ?>" <?= (isset($condominio['administrador_id']) && $condominio['administrador_id'] == $admin['id']) ? 'selected' : '' ?>>
                                        <?= esc($admin['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="<?= base_url('condominios') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-save me-2"></i> Guardar Dados
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>