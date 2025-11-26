<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center border-bottom">
        <div>
            <h5 class="m-0 fw-bold text-primary"><?= $title ?></h5>
            <small class="text-muted">Gerir registos do sistema</small>
        </div>
        <a href="<?= base_url($route . '/new') ?>" class="btn btn-primary shadow-sm rounded-3 px-4">
            <i class="fa-solid fa-plus me-2"></i> Novo
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover datatable align-middle w-100 mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3">ID</th>
                        <?php foreach($columns as $label): ?>
                            <th class="py-3"><?= $label ?></th>
                        <?php endforeach; ?>
                        <th class="text-end pe-4 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-secondary">#<?= $row['id'] ?></td>
                        
                        <?php foreach($columns as $key => $label): ?>
                            <td>
                                <?php 
                                    // Pequena melhoria visual para status/tipos
                                    $val = esc($row[$key] ?? '-');
                                    if($key == 'status' || $key == 'tipo') {
                                        echo '<span class="badge bg-light text-dark border">'.strtoupper($val).'</span>';
                                    } else {
                                        echo $val;
                                    }
                                ?>
                            </td>
                        <?php endforeach; ?>
                        
                        <td class="text-end pe-4">
                            <a href="<?= base_url($route . '/edit/' . $row['id']) ?>" class="btn btn-sm btn-light text-primary me-1" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <button class="btn btn-sm btn-light text-danger" 
                                    onclick="confirmAction('<?= base_url($route) ?>', <?= $row['id'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmAction(baseUrl, id) {
    Swal.fire({
        title: 'O que deseja fazer?',
        text: "Pode desativar (recuperável) ou apagar para sempre.",
        icon: 'warning',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonColor: '#f59e0b', // Amarelo para Desativar
        denyButtonColor: '#ef4444',    // Vermelho para Apagar
        cancelButtonColor: '#94a3b8',  // Cinza para Cancelar
        confirmButtonText: '<i class="fa-solid fa-power-off"></i> Desativar',
        denyButtonText: '<i class="fa-solid fa-trash"></i> Apagar Tudo',
        cancelButtonText: 'Cancelar',
        background: 'rgba(255, 255, 255, 0.98)',
        backdrop: `rgba(0,0,123,0.1)`
    }).then((result) => {
        if (result.isConfirmed) {
            // Ação: Desativar (Soft Delete)
            window.location.href = baseUrl + '/delete/' + id;
        } else if (result.isDenied) {
            // Ação: Apagar Permanente (Hard Delete)
            window.location.href = baseUrl + '/purge/' + id;
        }
    });
}
</script>

<?= $this->endSection() ?>