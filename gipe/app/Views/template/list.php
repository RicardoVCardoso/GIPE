<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php 
    $tipo = session()->get('tipo'); 
    $canManage = ($tipo === 'admin' || $tipo === 'gestor');
    if ($route === 'ocorrencias' && $tipo === 'morador') $canManage = true; 
    $trashCount = isset($trashData) ? count($trashData) : 0;
?>

<div class="card shadow-lg border-0 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h5 class="m-0 fw-bold text-primary"><?= $title ?></h5>
            <span class="text-muted small">Total ativos: <?= count($data) ?></span>
        </div>
        
        <div class="d-flex gap-2">
            <?php if(($tipo === 'admin' || $tipo === 'gestor')): ?>
                <button type="button" class="btn btn-outline-secondary shadow-sm px-3 rounded-3 position-relative" data-bs-toggle="modal" data-bs-target="#trashModal">
                    <i class="fa-solid fa-box-archive me-2"></i> Arquivo
                    <?php if($trashCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $trashCount ?>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endif; ?>

            <?php if($canManage || $route === 'reservas'): ?>
            <a href="<?= base_url($route . '/new') ?>" class="btn btn-primary shadow-sm px-4 rounded-3">
                <i class="fa-solid fa-plus me-2"></i> Novo
            </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100 mb-0 datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold" style="width: 50px;">N.º</th>
                        
                        <?php foreach($columns as $key => $label): ?>
                            <th class="py-3 text-uppercase text-muted small fw-bold"><?= $label ?></th>
                        <?php endforeach; ?>
                        <?php if($canManage): ?><th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Ações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; ?>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">
                            <?= $counter++ ?>
                            <small class="text-muted opacity-25 fw-light ms-1" style="font-size: 0.7em;">#<?= $row['id'] ?></small>
                        </td>

                        <?php foreach($columns as $key => $label): ?>
                            <td>
                                <?php 
                                    $val = esc($row[$key] ?? '-');
                                    if ($key == 'status' || $key == 'lida'): 
                                        $badgeClass = 'bg-secondary';
                                        if(in_array($val, ['ativo', 'paga', 'pago', 'resolvida', '1', 'concluida'])) $badgeClass = 'bg-success';
                                        if(in_array($val, ['pendente', '0'])) $badgeClass = 'bg-warning text-dark';
                                        if(in_array($val, ['bloqueado', 'rejeitada'])) $badgeClass = 'bg-danger';
                                        echo "<span class='badge {$badgeClass} bg-opacity-75 rounded-pill px-3'>".strtoupper($val)."</span>";
                                    else: echo $val; endif; 
                                ?>
                            </td>
                        <?php endforeach; ?>
                        
                        <?php if($canManage): ?>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                
                                <?php if(isset($row['status']) && $row['status'] === 'pendente' && $route === 'utilizadores'): ?>
                                    <a href="<?= base_url($route.'/status/'.$row['id'].'/ativo') ?>" class="btn btn-sm btn-success text-white" title="Aprovar Registo">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if(isset($row['status']) && $row['status'] !== 'pago' && $route === 'pagamentos'): ?>
                                    <a href="<?= base_url($route.'/status/'.$row['id'].'/pago') ?>" class="btn btn-sm btn-success text-white shadow-sm" title="Confirmar Pagamento">
                                        <i class="fa-solid fa-money-bill-wave"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <a href="<?= base_url($route . '/edit/' . $row['id']) ?>" class="btn btn-sm btn-light text-primary border" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <?php if($tipo !== 'morador'): ?>
                                    <button class="btn btn-sm btn-light text-danger border" onclick="confirmDelete('<?= base_url($route) ?>', <?= $row['id'] ?>)" title="Arquivar">
                                        <i class="fa-solid fa-box-archive"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="trashModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header bg-danger bg-opacity-10 border-bottom-0 py-3">
                <h5 class="modal-title text-danger fw-bold"><i class="fa-solid fa-trash-can me-2"></i> Arquivo de <?= $title ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 bg-light">
                <?php if(empty($trashData)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-folder-open fs-1 mb-3 opacity-25 d-block"></i>
                        O arquivo está vazio.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle w-100 mb-0">
                            <thead class="bg-white sticky-top">
                                <tr>
                                    <th class="ps-4">ID Original</th>
                                    <?php foreach($columns as $label): ?><th><?= $label ?></th><?php endforeach; ?>
                                    <th class="text-end pe-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($trashData as $trashRow): ?>
                                <tr class="bg-white border-bottom">
                                    <td class="ps-4 text-muted">#<?= $trashRow['id'] ?></td>
                                    <?php foreach($columns as $k => $l): ?>
                                        <td class="text-muted text-decoration-line-through"><?= esc($trashRow[$k] ?? '-') ?></td>
                                    <?php endforeach; ?>
                                    <td class="text-end pe-4">
                                        <a href="<?= base_url($route . '/restore/' . $trashRow['id']) ?>" class="btn btn-sm btn-success text-white me-2" title="Restaurar">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </a>
                                        <a href="<?= base_url($route . '/purge/' . $trashRow['id']) ?>" class="btn btn-sm btn-danger text-white" onclick="return confirm('ATENÇÃO: Apagar para sempre?');" title="Eliminar Definitivo">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer border-top-0 bg-white rounded-bottom-4">
                <button type="button" class="btn btn-light text-muted" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(baseUrl, id) {
    Swal.fire({
        title: 'Arquivar Registo?',
        text: "O item será movido para o Arquivo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f59e0b',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Sim, arquivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = baseUrl + '/delete/' + id;
        }
    });
}
</script>

<?= $this->endSection() ?>