<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 factura-container">
  <h1 class="mb-4">Factura #<?= esc($factura['id_factura']) ?></h1>

  <div class="mb-4">
    <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($factura['fecha'])) ?></p>
    <p><strong>Total:</strong> $<?= number_format($factura['total'], 0, ',', '.') ?></p>
  </div>

  <h4>Detalle de la compra</h4>
  <div class="table-responsive">
    <table class="table table-bordered factura-table">
      <thead class="table-light">
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio unitario</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detalles as $item): ?>
          <tr>
            <td><?= esc($item['nombre_producto']) ?></td>
            <td><?= esc($item['cantidad']) ?></td>
            <td>$<?= number_format($item['precio'], 0, ',', '.') ?></td>
            <td>$<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <a href="<?= previous_url() ?>" class="btn btn-outline-secondary mt-4">Volver</a>

</div>

<?= $this->endSection() ?>
