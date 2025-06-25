<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 perfil-container custom-container">
  <h1 class="mb-4 perfil-title custom-perfil-title">Mi perfil</h1>

  <!-- Datos personales -->
  <div class="card mb-4 perfil-card custom-perfil-card">
    <div class="card-header fw-bold perfil-card-header custom-perfil-card-header">Datos personales</div>
    <div class="card-body perfil-card-body custom-perfil-card-body">
      <form method="post" action="<?= site_url('perfil/actualizar') ?>" onsubmit="return confirm('¿Deseas guardar los cambios en tus datos personales?')" class="custom-form-datos-personales">
        <?= csrf_field() ?>
        <div class="mb-3 custom-form-group-nombre">
          <label for="nombre" class="form-label perfil-label custom-label-nombre">Nombre</label>
          <input type="text" class="form-control perfil-input custom-input-nombre" name="nombre" id="nombre" value="<?= esc($usuario['nombre']) ?>" required>
        </div>
        <div class="mb-3 custom-form-group-email">
          <label for="email" class="form-label perfil-label custom-label-email">Email</label>
          <input type="email" class="form-control perfil-input custom-input-email" name="email" id="email" value="<?= esc($usuario['email']) ?>" required>
        </div>
        <div class="mb-3 custom-form-group-celular">
          <label for="celular" class="form-label perfil-label custom-label-celular">Celular</label>
          <input type="text" class="form-control perfil-input custom-input-celular" name="celular" id="celular" value="<?= esc($usuario['celular']) ?>" required>
        </div>

        <!-- Cambiar contraseña -->
        <div id="cambio-password" class="mb-3 perfil-password-group custom-perfil-password-group" style="display: none;">
          <label for="nueva_password" class="form-label perfil-label custom-label-nueva-password">Nueva contraseña</label>
          <input type="password" class="form-control perfil-input mb-2 custom-input-nueva-password" name="nueva_password" id="nueva_password">
          <label for="confirmar_password" class="form-label perfil-label custom-label-confirmar-password">Confirmar contraseña</label>
          <input type="password" class="form-control perfil-input custom-input-confirmar-password" name="confirmar_password" id="confirmar_password">
        </div>

        <button type="button" class="btn btn-outline-secondary btn-sm mb-3 custom-btn-cambiar-password" onclick="document.getElementById('cambio-password').style.display = 'block'; this.style.display='none'">Cambiar contraseña</button>
        <br>
        <button type="submit" class="btn btn-primary custom-btn-guardar-cambios">Guardar cambios</button>
      </form>
    </div>
  </div>

  <!-- Dirección -->
  <div class="card mb-4 custom-card-direccion">
    <div class="card-header fw-bold custom-card-header-direccion">Dirección</div>
    <div class="card-body custom-card-body-direccion">
      <form method="post" action="<?= site_url('perfil/direccion') ?>" onsubmit="return confirm('¿Deseas guardar los cambios en tu dirección?')" class="custom-form-direccion">
        <?= csrf_field() ?>
        <?php if ($direccion): ?>
          <div id="direccion-lectura" class="custom-direccion-lectura">
            <p><strong>Calle:</strong> <?= esc($direccion['calle']) ?></p>
            <p><strong>Altura:</strong> <?= esc($direccion['altura']) ?></p>
            <p><strong>Ciudad:</strong> <?= esc($direccion['ciudad']) ?></p>
            <p><strong>Localidad:</strong> <?= esc($direccion['localidad']) ?></p>
            <button type="button" class="btn btn-outline-secondary btn-sm custom-btn-editar-direccion" onclick="habilitarDireccion()">Editar dirección</button>
          </div>
        <?php endif; ?>

        <div id="form-direccion" style="display: <?= $direccion ? 'none' : 'block' ?>" class="custom-form-direccion-inputs">
          <div class="mb-2 custom-form-group-calle">
            <label for="calle" class="form-label custom-label-calle">Calle</label>
            <input type="text" class="form-control custom-input-calle" name="calle" id="calle" value="<?= esc($direccion['calle'] ?? '') ?>" required>
          </div>
          <div class="mb-2 custom-form-group-altura">
            <label for="altura" class="form-label custom-label-altura">Altura</label>
            <input type="text" class="form-control custom-input-altura" name="altura" id="altura" value="<?= esc($direccion['altura'] ?? '') ?>" required>
          </div>
          <div class="mb-2 custom-form-group-ciudad">
            <label for="ciudad" class="form-label custom-label-ciudad">Ciudad</label>
            <input type="text" class="form-control custom-input-ciudad" name="ciudad" id="ciudad" value="<?= esc($direccion['ciudad'] ?? '') ?>" required>
          </div>
          <div class="mb-2 custom-form-group-localidad">
            <label for="localidad" class="form-label custom-label-localidad">Localidad</label>
            <input type="text" class="form-control custom-input-localidad" name="localidad" id="localidad" value="<?= esc($direccion['localidad'] ?? '') ?>" required>
          </div>
          <button type="submit" class="btn btn-success custom-btn-guardar-direccion">Guardar dirección</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Historial de compras -->
  <div class="card mb-4 custom-card-historial-compras">
    <div class="card-header d-flex justify-content-between align-items-center custom-card-header-historial">
      <h5 class="mb-0 custom-historial-titulo">Historial de compras</h5>
      <button class="btn btn-sm btn-outline-dark custom-btn-toggle-historial" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down custom-icon-chevron">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </button>
    </div>
    <div id="collapseCompras" class="collapse custom-collapse-compras">
      <div class="card-body custom-card-body-compras">
        <?php if (!empty($facturas)): ?>
          <ul class="list-group custom-list-group-facturas">
            <?php foreach ($facturas as $factura): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center custom-list-item-factura">
                <div class="custom-factura-info">
                  <strong>Compra:</strong> <?= date('d/m/Y H:i', strtotime($factura['fecha'])) ?> – 
                  <strong>Total:</strong> $<?= number_format($factura['total'], 0, ',', '.') ?>
                </div>
                <a href="<?= site_url('factura/ver/' . $factura['id_factura']) ?>" class="btn btn-sm btn-outline-secondary custom-btn-ver-factura" title="Ver factura">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye custom-icon-eye">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="custom-text-no-compras">No hay compras registradas.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Desactivar cuenta -->
  <form method="post" action="<?= site_url('perfil/desactivar') ?>" onsubmit="return confirm('¿Estás seguro que deseas desactivar tu cuenta?')" class="custom-form-desactivar-cuenta">
    <?= csrf_field() ?>
    <button type="submit" class="btn btn-danger custom-btn-desactivar-cuenta">Desactivar cuenta</button>
  </form>
</div>

<script>
  function habilitarDireccion() {
    document.getElementById('direccion-lectura').style.display = 'none';
    document.getElementById('form-direccion').style.display = 'block';
  }
</script>

<?= $this->endSection() ?>
