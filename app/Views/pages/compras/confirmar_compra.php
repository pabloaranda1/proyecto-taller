<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 confirmar-compra-container">
  <h1>Confirmar compra</h1>

  <form method="post" action="<?= site_url('carrito/confirmar') ?>">
    <?= csrf_field() ?>

    <!-- Medio de pago -->
    <div class="mb-3">
      <label for="medio_pago" class="form-label">Medio de pago</label>
      <select name="medio_pago" id="medio_pago" class="form-select" required>
        <option value="">-- Seleccione --</option>
        <?php foreach ($mediosPago as $medio): ?>
          <option value="<?= strtolower($medio) ?>"><?= esc($medio) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Tipo de entrega -->
    <div class="mb-3">
      <label for="tipo_entrega" class="form-label">Tipo de entrega</label>
      <select name="tipo_entrega" id="tipo_entrega" class="form-select" required>
        <option value="">-- Seleccione --</option>
        <option value="retiro">Retiro en local</option>
        <option value="envio">Envío a domicilio</option>
      </select>
        <!-- Este hidden siempre se envía por defecto -->
        <input type="hidden" name="usar_direccion_existente" value="si">
    </div>

    <!-- Bloque de dirección, oculto inicialmente -->
    <div id="bloque-direccion" style="display:none;">
      <?php if ($direccion): ?>
        <div class="mb-3">
          <p><strong>Dirección registrada:</strong></p>
          <ul>
            <li>Calle: <?= esc($direccion['calle']) ?></li>
            <li>Altura: <?= esc($direccion['altura']) ?></li>
            <li>Ciudad: <?= esc($direccion['ciudad']) ?></li>
            <li>Localidad: <?= esc($direccion['localidad']) ?></li>
          </ul>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="usar_direccion_existente" id="usarDirSi" value="si" checked>
            <label class="form-check-label" for="usarDirSi">Usar esta dirección</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="usar_direccion_existente" id="usarDirNo" value="no">
            <label class="form-check-label" for="usarDirNo">Ingresar una nueva dirección</label>
          </div>
        </div>
      <?php else: ?>
        <input type="hidden" name="usar_direccion_existente" value="no">
        <p>No tienes dirección registrada. Por favor, completa los datos a continuación.</p>
      <?php endif; ?>

      <div id="form-nueva-direccion" style="display: <?= $direccion ? 'none' : 'block' ?>;">
        <div class="mb-3">
          <label for="calle" class="form-label">Calle</label>
          <input type="text" name="calle" id="calle" class="form-control" <?= $direccion ? 'disabled' : 'required' ?> minlength="3" maxlength="100">
        </div>
        <div class="mb-3">
          <label for="altura" class="form-label">Altura</label>
          <input type="text" name="altura" id="altura" class="form-control" <?= $direccion ? 'disabled' : 'required' ?> minlength="1" maxlength="4" pattern="\d+">
        </div>
        <div class="mb-3">
          <label for="ciudad" class="form-label">Ciudad</label>
          <input type="text" name="ciudad" id="ciudad" class="form-control" <?= $direccion ? 'disabled' : 'required' ?>>
        </div>
        <div class="mb-3">
          <label for="localidad" class="form-label">Localidad</label>
          <input type="text" name="localidad" id="localidad" class="form-control" <?= $direccion ? 'disabled' : 'required' ?>>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Confirmar compra</button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const formDireccion = document.getElementById('form-nueva-direccion');
  const direccionInputs = formDireccion.querySelectorAll('input');
  const tipoEntregaSelect = document.getElementById('tipo_entrega');
  const usarDireccionRadios = document.querySelectorAll('input[name="usar_direccion_existente"]');
  const bloqueDireccion = document.getElementById('bloque-direccion');

  function actualizarEstadoDireccion() {
    const tipoEntrega = tipoEntregaSelect.value;
    const usarExistenteSeleccionado = document.querySelector('input[name="usar_direccion_existente"]:checked');

    if (tipoEntrega === 'envio') {
      bloqueDireccion.style.display = 'block';
      if (!usarExistenteSeleccionado || usarExistenteSeleccionado.value === 'no') {
        formDireccion.style.display = 'block';
        direccionInputs.forEach(input => {
          input.disabled = false;
          input.required = true;
        });
      } else {
        formDireccion.style.display = 'none';
        direccionInputs.forEach(input => {
          input.disabled = true;
          input.required = false;
        });
      }
    } else {
      bloqueDireccion.style.display = 'none';
      formDireccion.style.display = 'none';
      direccionInputs.forEach(input => {
        input.disabled = true;
        input.required = false;
      });
    }
  }

  tipoEntregaSelect.addEventListener('change', actualizarEstadoDireccion);

  usarDireccionRadios.forEach(radio => {
    radio.addEventListener('change', actualizarEstadoDireccion);
  });

  // Ejecutar al cargar
  actualizarEstadoDireccion();
});
</script>


<?= $this->endSection() ?>
