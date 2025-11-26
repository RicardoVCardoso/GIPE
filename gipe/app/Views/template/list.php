<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        <a href="<?= base_url($route . '/new') ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Novo</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <?php foreach($columns as $label): ?><th><?= $label ?></th><?php endforeach; ?>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <?php foreach($columns as $key => $label): ?>
                            <td><?= esc($row[$key] ?? '-') ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="<?= base_url($route . '/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <a href="<?= base_url($route . '/delete/' . $row['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apagar este registo?')"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>