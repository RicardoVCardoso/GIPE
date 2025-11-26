<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url($route . '/' . $action) ?>" method="post">
                    <?= csrf_field() ?>
                    <?php foreach($fields as $field => $config): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase"><?= $config['label'] ?></label>
                            <?php 
                                $val = isset($item[$field]) ? $item[$field] : '';
                                if($config['type'] == 'select'): 
                            ?>
                                <select name="<?= $field ?>" class="form-select" required>
                                    <option value="">Selecione...</option>
                                    <?php foreach($config['options'] as $k => $v): ?>
                                        <option value="<?= $k ?>" <?= $val == $k ? 'selected' : '' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif($config['type'] == 'textarea'): ?>
                                <textarea name="<?= $field ?>" class="form-control" rows="3"><?= esc($val) ?></textarea>
                            <?php else: ?>
                                <input type="<?= $config['type'] ?>" name="<?= $field ?>" class="form-control" value="<?= esc($val) ?>" <?= $config['type']=='password'?'':'required' ?>>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="text-end mt-4">
                        <a href="<?= base_url($route) ?>" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>