<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 carrito-container">
  <h1><?= esc($titulo) ?></h1>

  <?php if (empty($productosCarrito)): ?>
    <p>Tu carrito está vacío.</p>
  <?php else: ?>
    <table class="table-minimalista align-middle">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio unitario</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productosCarrito as $prod): ?>
          <tr data-id="<?= esc($prod['id_item_carrito']) ?>">
            <td>
              <img src="<?= base_url('assets/images/productos/' . $prod['imagen']) ?>" alt="<?= esc($prod['nombre']) ?>" width="70" class="me-2">
              <?= esc($prod['nombre']) ?>
            </td>
            <td>$<?= number_format($prod['precio'], 0, ',', '.') ?></td>
            <td>
                <span class="cantidad-text"><?= esc($prod['cantidad']) ?></span>
            </td>

            <td class="subtotal">$<?= number_format($prod['subtotal'], 0, ',', '.') ?></td>
            <td>
                <a href="<?= site_url('carrito/eliminar/' . esc($prod['id_item_carrito'])) ?>" 
                class="btn-minimalista btn-eliminar">Eliminar</a>
                <script>
                    document.querySelectorAll('.btn-eliminar').forEach(btn => {
                        btn.addEventListener('click', function(event) {
                        if (!confirm('¿Estás seguro que querés eliminar este producto del carrito?')) {
                            event.preventDefault(); // Cancela la navegación si el usuario presiona "Cancelar"
                        }
                        });
                    });
                </script>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Total:</th>
          <th id="total">$<?= number_format($total, 0, ',', '.') ?></th>
          <th></th>
        </tr>
      </tfoot>
    </table>

    <div class="d-flex justify-content-between">
        <a href="<?= esc($url_volver) ?>" class="btn btn-secondary btn-minimalista">
            ← Volver
        </a>
        <a href="<?= site_url('carrito/confirmar') ?>" class="btn btn-primary">
            Proceder a la compra
        </a>
    </div>

  <?php endif; ?>
</div>

<?= $this->endSection() ?>
