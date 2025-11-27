<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php 
    // Contagem de itens no lixo para o badge
    $trashCount = isset($trashData) ? count($trashData) : 0; 
?>

<div class="card shadow-lg border-0 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h5 class="m-0 fw-bold text-primary"><i class="fa-regular fa-building me-2"></i> <?= $title ?></h5>
            <span class="text-muted small">Total ativos: <?= count($condominios) ?></span>
        </div>
        
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary shadow-sm px-3 rounded-3 position-relative" data-bs-toggle="modal" data-bs-target="#trashModal">
                <i class="fa-solid fa-box-archive me-2"></i> Arquivo
                <?php if($trashCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $trashCount ?>
                    </span>
                <?php endif; ?>
            </button>

            <a href="<?= base_url('condominios/new') ?>" class="btn btn-primary shadow-sm px-4 rounded-3">
                <i class="fa-solid fa-plus me-2"></i> Novo
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100 mb-0 datatable">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold" style="width: 50px;">N.º</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Nome</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Endereço</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Telefone</th>
                        <th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 1; // Contador Visual Sequencial ?>
                    <?php foreach($condominios as $row): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">
                            <?= $counter++ ?>
                            <small class="text-muted opacity-25 fw-light ms-1" style="font-size: 0.7em;">#<?= $row['id'] ?></small>
                        </td>
                        
                        <td class="fw-bold text-dark"><?= esc($row['nome']) ?></td>
                        <td class="text-muted"><?= esc($row['endereco']) ?></td>
                        <td><?= esc($row['telefone']) ?></td>
                        
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url('condominios/edit/' . $row['id']) ?>" class="btn btn-sm btn-light text-primary border" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-light text-danger border" onclick="confirmArchive('<?= $row['id'] ?>')" title="Arquivar">
                                    <i class="fa-solid fa-box-archive"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="trashModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger bg-opacity-10 border-0 py-3">
                <h5 class="modal-title text-danger fw-bold"><i class="fa-solid fa-trash-can me-2"></i> Arquivo de Condomínios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <?php if(empty($trashData)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-folder-open fs-1 mb-3 opacity-25 d-block"></i>
                        O arquivo está vazio.
                    </div>
                <?php else: ?>
                    <table class="table table-hover align-middle w-100 mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">ID Original</th>
                                <th>Nome</th>
                                <th>Removido em</th>
                                <th class="text-end pe-4">Recuperar / Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trashData as $trash): ?>
                            <tr class="bg-white border-bottom">
                                <td class="ps-4 text-muted">#<?= $trash['id'] ?></td>
                                <td class="text-decoration-line-through text-muted"><?= esc($trash['nome']) ?></td>
                                <td class="small text-muted"><?= $trash['deleted_at'] ?></td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('condominios/restore/' . $trash['id']) ?>" class="btn btn-sm btn-success text-white me-2" title="Restaurar">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger text-white" onclick="confirmPurge('<?= $trash['id'] ?>')" title="Eliminar Definitivo">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Função para ARQUIVAR (Soft Delete)
 * Move para o modal de lixo
 */
function confirmArchive(id) {
    Swal.fire({
        title: 'Arquivar Condomínio?',
        text: "O condomínio sairá da lista ativa e irá para o arquivo.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f59e0b', // Amarelo/Laranja
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Sim, arquivar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('condominios/delete') ?>/' + id;
        }
    });
}

/**
 * Função para ELIMINAR DE VEZ (Hard Delete/Purge)
 * Remove da base de dados permanentemente
 */
function confirmPurge(id) {
    Swal.fire({
        title: 'Tem a certeza absoluta?',
        text: "Esta ação é IRREVERSÍVEL. O condomínio e todos os dados associados serão apagados para sempre!",
        icon: 'error', // Ícone vermelho de perigo
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // Vermelho
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Sim, eliminar tudo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('condominios/purge') ?>/' + id;
        }
    });
}
</script>

<?= $this->endSection() ?>