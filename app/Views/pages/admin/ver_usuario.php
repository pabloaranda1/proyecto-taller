<?php $mainClass = 'container my-5'; // para escritorio ?>
<?= $this->extend('templates/base') ?>

<?= $this->section('content') ?>

<div class="container-fluid my-5">
    <div class="card tarjeta-detalle-usuario ms-3" style="max-width: 550px; width: 100%;">
        <div class="card-body">
            <h4 class="mb-4">Gestión de Usuario</h4>

            <form id="form-editar-usuario" class="formulario-usuario-detalle" action="<?= site_url('admin/usuarios/actualizar/' . $usuario['id_usuario']) ?>" method="post">

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="flex-shrink-0" style="width: 120px;">
                        <label class="form-label mb-0">Nombre</label>
                    </div>
                    <div class="position-relative contenedor-campo-editable">
                        <input type="text" name="nombre" id="nombre" value="<?= esc($usuario['nombre']) ?>" class="campo-usuario" readonly>
                        <button type="button" class="btn editar-campo position-absolute top-50 end-0 translate-middle-y me-2" data-campo="nombre">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="flex-shrink-0" style="width: 120px;">
                        <label class="form-label mb-0">Email</label>
                    </div>
                    <div class="position-relative contenedor-campo-editable">
                        <input type="email" name="email" id="email" value="<?= esc($usuario['email']) ?>" class="campo-usuario" readonly>
                        <button type="button" class="btn editar-campo position-absolute top-50 end-0 translate-middle-y me-2" data-campo="email">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <div class="flex-shrink-0" style="width: 120px;">
                        <label class="form-label mb-0">Celular</label>
                    </div>
                    <div class="position-relative contenedor-campo-editable">
                        <input type="text" name="celular" id="celular" value="<?= esc($usuario['celular']) ?>" class="campo-usuario" readonly>
                        <button type="button" class="btn editar-campo position-absolute top-50 end-0 translate-middle-y me-2" data-campo="celular">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4 contraseña-wrapper">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0" style="width: 120px;">
                            <label class="form-label mb-0">Contraseña</label>
                        </div>
                        <div class="position-relative contenedor-campo-editable">
                            <input type="password" name="password" id="password" class="campo-usuario" placeholder="••••••••" readonly>
                            <button type="button" class="btn editar-campo position-absolute top-50 end-0 translate-middle-y me-2" data-campo="password">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Campo Confirmar contraseña (oculto inicialmente) -->
                    <div class="d-flex align-items-center gap-3 mt-3 d-none" id="confirmar-password-group">
                        <div class="flex-shrink-0" style="width: 120px;">
                            <label class="form-label mb-0">Confirmar</label>
                        </div>
                        <div class="position-relative contenedor-campo-editable">
                            <input type="password" name="password_confirm" id="password_confirm" class="campo-usuario" placeholder="Repetir nueva contraseña">
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between align-items-center mt-4 gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-guardar" disabled>Guardar Cambios</button>
                    <span id="tick-guardado" class="text-success ms-2 d-none">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>

                    <a href="<?= site_url('admin/usuarios/facturas/' . $usuario['id_usuario']) ?>" 
                    class="btn btn-secondary btn-sm">
                    Ver Facturas
                    </a>
                
                    <?php if ($usuario['activo']): ?>
                        <a href="<?= site_url('admin/usuarios/desactivar/' . $usuario['id_usuario']) ?>" 
                        class="btn btn-outline-danger btn-sm" 
                        onclick="return confirm('¿Desactivar este usuario?')">Desactivar Usuario</a>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
