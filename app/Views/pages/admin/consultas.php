<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4 admin-consultas">
    <h1 class="mb-4">Consultas de Usuarios</h1>

    <h4 class="titulo-tabla">Con sesión iniciada</h4>
    <table class="table table-bordered table-sm tabla-consultas tabla-sesion">
        <thead class="table-light">
            <tr>
                <th class="col-2">Usuario</th>
                <th class="col-2">Email</th>
                <th class="col-6">Mensaje</th>
                <th class="col-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($consultasConSesion)): ?>
                <tr><td colspan="4" class="text-center">No hay consultas con sesión iniciada.</td></tr>
            <?php else: ?>
                <?php foreach($consultasConSesion as $consulta): ?>
                    <tr>
                        <td>
                            <a href="<?= site_url('admin/usuarios/editar/' . $consulta['id_usuario']) ?>" class="link-usuario">
                                <?= esc($consulta['nombre']) ?>
                            </a>
                        </td>
                        <td><?= esc($consulta['email']) ?></td>
                        <td><?= esc(strlen($consulta['mensaje']) > 40 ? substr($consulta['mensaje'], 0, 40) . '...' : $consulta['mensaje']) ?></td>
                        <td>
                            <a href="<?= site_url('admin/consultas/ver/' . $consulta['id_consulta']) ?>" class="btn btn-primary btn-sm">
                                Ver
                            </a>
                            <a href="<?= site_url('admin/consultas/toggleLeido/' . $consulta['id_consulta']) ?>"
                                class="btn btn-sm <?= $consulta['leido'] ? 'btn-success' : 'btn-secondary' ?>"
                                title="<?= $consulta['leido'] ? 'Marcar como no leído' : 'Marcar como leído' ?>">
                                    <?= $consulta['leido'] ? 'Leído' : 'No leído' ?>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="paginacion-consultas mb-5">
        <?= $pager->makeLinks($pageConSesion, $perPage, $totalConSesion, 'default_full', 3) ?>
    </div>

    <h4 class="titulo-tabla mt-5">Sin sesión iniciada</h4>
    <table class="table table-bordered table-sm tabla-consultas tabla-sin-sesion">
        <thead class="table-light">
            <tr>
                <th class="col-2">Usuario</th>
                <th class="col-2">Email</th>
                <th class="col-6">Mensaje</th>
                <th class="col-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($consultasSinSesion)): ?>
                <tr><td colspan="4" class="text-center">No hay consultas sin sesión iniciada.</td></tr>
            <?php else: ?>
                <?php foreach($consultasSinSesion as $consulta): ?>
                    <tr>
                        <td><?= esc($consulta['nombre']) ?></td>
                        <td><?= esc($consulta['email']) ?></td>
                        <td><?= esc(strlen($consulta['mensaje']) > 40 ? substr($consulta['mensaje'], 0, 40) . '...' : $consulta['mensaje']) ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= site_url('admin/consultasSinSesion/ver/' . $consulta['id_consulta']) ?>" class="btn btn-primary btn-sm">
                                    Ver
                                </a>
                                <a href="<?= site_url('admin/consultasSinSesion/toggleLeido/' . $consulta['id_consulta']) ?>"
                                    class="btn btn-sm <?= $consulta['leido'] ? 'btn-success' : 'btn-secondary' ?>"
                                    title="<?= $consulta['leido'] ? 'Marcar como no leído' : 'Marcar como leído' ?>">
                                        <?= $consulta['leido'] ? 'Leído' : 'No leído' ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="paginacion-consultas">
        <?= $pager->makeLinks($pageSinSesion, $perPage, $totalSinSesion, 'default_full', 3) ?>
    </div>
</div>

<?= $this->endSection() ?>
