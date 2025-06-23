<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Usuarios desactivados</h2>

    <a href="<?= site_url('admin/usuarios') ?>" class="btn btn-secondary mb-3">Ver activos</a>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($usuarios)): ?>
                <tr><td colspan="6" class="text-center">No hay usuarios desactivados.</td></tr>
            <?php else: ?>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= esc($u['id_usuario']) ?></td>
                    <td><?= esc($u['nombre']) ?></td>
                    <td><?= esc($u['email']) ?></td>
                    <td><?= $u['es_admin'] ? 'Admin' : 'Cliente' ?></td>
                    <td>
                        <a href="<?= site_url('admin/usuarios/ver_usuario/' . $u['id_usuario']) ?>" class="btn btn-sm btn-primary">Ver</a>
                        <a href="<?= site_url('admin/usuarios/reactivar/' . $u['id_usuario']) ?>" class="btn btn-sm btn-success" onclick="return confirm('¿Reactivar este usuario?')">Reactivar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
