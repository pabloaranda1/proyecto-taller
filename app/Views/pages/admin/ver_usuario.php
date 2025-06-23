<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Detalle del Usuario</h2>

    <div class="card mb-3">
        <div class="card-body usuario-detalle" style="max-width: 600px; margin: auto;">
            <form id="form-editar-usuario" action="<?= site_url('admin/usuarios/actualizar/' . $usuario['id_usuario']) ?>" method="post">
                <?php foreach (['nombre', 'email', 'celular'] as $campo): ?>
                    <div class="form-group mb-3 d-flex align-items-center">
                        <label class="me-2 mb-0" style="width: 80px;"><?= ucfirst($campo) ?>:</label>
                        <div class="flex-grow-1 position-relative">
                            <input type="<?= $campo === 'email' ? 'email' : 'text' ?>" 
                                name="<?= $campo ?>" 
                                value="<?= esc($usuario[$campo]) ?>" 
                                class="form-control form-control-sm" 
                                readonly>
                            <button type="button" class="btn btn-link p-0 position-absolute top-50 end-0 translate-middle-y editar-campo" data-campo="<?= $campo ?>" title="Editar <?= $campo ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-sm btn-primary" id="btn-guardar" disabled>Guardar Cambios</button>
                    <?php if ($usuario['activo']): ?>
                        <a href="<?= site_url('admin/usuarios/desactivar/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Desactivar este usuario?')">Desactivar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
