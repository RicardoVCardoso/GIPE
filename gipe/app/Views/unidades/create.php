<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 fw-bold text-primary">Registar Nova Unidade</h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('unidades/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Condomínio</label>
                            <select name="id_condominio" class="form-select" required>
                                <option value="" selected disabled>Selecione...</option>
                                <?php foreach($condominios as $cond): ?>
                                    <option value="<?= $cond['id'] ?>"><?= $cond['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small text-uppercase fw-bold">Proprietário</label>
                            <select name="proprietario_id" class="form-select">
                                <option value="">-- Sem Proprietário --</option>
                                <?php foreach($proprietarios as $prop): ?>
                                    <option value="<?= $prop['id'] ?>"><?= $prop['nome'] ?> (<?= $prop['email'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted small text-uppercase fw-bold">Número / Porta</label>
                            <input type="text" name="numero" class="form-control" placeholder="Ex: 3º Esq" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted small text-uppercase fw-bold">Tipo</label>
                            <select name="tipo" class="form-select" required>
                                <option value="apartamento">Apartamento</option>
                                <option value="casa">Casa</option>
                                <option value="cobertura">Cobertura</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted small text-uppercase fw-bold">Fração (%)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="fracao" class="form-control" placeholder="Ex: 5.20" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('unidades') ?>" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4"><i class="fa-solid fa-save me-2"></i> Guardar Unidade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>