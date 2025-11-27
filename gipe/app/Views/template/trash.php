<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-lg border-0 overflow-hidden border-danger border-start border-4">
    <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h5 class="m-0 fw-bold text-danger"><i class="fa-solid fa-trash-can me-2"></i> Arquivo de <?= $title ?></h5>
            <span class="text-muted small">Registos eliminados (Reciclagem)</span>
        </div>
        <a href="<?= base_url($route) ?>" class="btn btn-light shadow-sm px-4 rounded-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Voltar
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100 mb-0 datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">ID</th>
                        <?php foreach($columns as $key => $label): ?>
                            <th class="py-3 text-uppercase text-muted small fw-bold"><?= $label ?></th>
                        <?php endforeach; ?>
                        <th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr class="bg-danger bg-opacity-10">
                        <td class="ps-4 fw-bold text-danger">#<?= $row['id'] ?></td>
                        
                        <?php foreach($columns as $key => $label): ?>
                            <td class="text-muted text-decoration-line-through"><?= esc($row[$key] ?? '-') ?></td>
                        <?php endforeach; ?>
                        
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url($route . '/restore/' . $row['id']) ?>" class="btn btn-sm btn-success shadow-sm" title="Restaurar">
                                    <i class="fa-solid fa-trash-arrow-up me-1"></i> Restaurar
                                </a>
                                
                                <a href="<?= base_url($route . '/purge/' . $row['id']) ?>" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('ATENÇÃO: Isto vai apagar o registo e todas as suas dependências para sempre. Continuar?');" title="Eliminar Definitivamente">
                                    <i class="fa-solid fa-radiation"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if(empty($data)): ?>
                        <tr>
                            <td colspan="100%" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-folder-open fs-1 mb-3 d-block opacity-25"></i>
                                O arquivo está vazio.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>