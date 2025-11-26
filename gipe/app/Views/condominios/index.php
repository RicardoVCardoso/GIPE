<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Condomínios</h2>
    <a href="/condominios/create" class="btn btn-success">Novo Condomínio</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Administrador</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($condominios as $condominio): ?>
        <tr>
            <td><?= $condominio['id'] ?></td>
            <td><?= $condominio['nome'] ?></td>
            <td><?= $condominio['endereco'] ?></td>
            <td><?= $condominio['nome_admin'] ?? 'Sem Admin' ?></td>
            <td>
                <a href="#" class="btn btn-sm btn-primary">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>