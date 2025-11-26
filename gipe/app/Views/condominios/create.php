<h2>Adicionar Condomínio</h2>
<form action="/condominios/store" method="post">
    <div class="mb-3">
        <label>Nome do Condomínio</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Endereço</label>
        <input type="text" name="endereco" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label>Administrador Responsável</label>
        <select name="administrador_id" class="form-control">
            <option value="">Selecione...</option>
            <?php foreach($admins as $admin): ?>
                <option value="<?= $admin['id'] ?>"><?= $admin['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="/condominios" class="btn btn-secondary">Cancelar</a>
</form>