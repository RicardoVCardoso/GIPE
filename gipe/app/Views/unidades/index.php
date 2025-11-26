<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
        <h6 class="m-0 fw-bold text-primary">Gestão de Unidades</h6>
        <a href="<?= base_url('unidades/create') ?>" class="btn btn-primary btn-sm rounded-pill px-3">
            <i class="fa-solid fa-plus me-1"></i> Nova Unidade
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover datatable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Condomínio</th>
                        <th>Número/Porta</th>
                        <th>Tipo</th>
                        <th>Fração (%)</th>
                        <th>Proprietário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($unidades as $unidade): ?>
                    <tr>
                        <td><?= $unidade['id'] ?></td>
                        <td><span class="badge bg-light text-dark border"><?= $unidade['nome_condominio'] ?></span></td>
                        <td class="fw-bold"><?= $unidade['numero'] ?></td>
                        <td>
                            <?php if($unidade['tipo'] == 'apartamento'): ?>
                                <i class="fa-regular fa-building text-primary me-1"></i> Apt
                            <?php elseif($unidade['tipo'] == 'casa'): ?>
                                <i class="fa-solid fa-house text-success me-1"></i> Casa
                            <?php else: ?>
                                <i class="fa-solid fa-layer-group text-warning me-1"></i> Cob
                            <?php endif; ?>
                        </td>
                        <td><?= $unidade['fracao'] ?>%</td>
                        <td><?= $unidade['nome_proprietario'] ?: '<em class="text-muted">Vago</em>' ?></td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>