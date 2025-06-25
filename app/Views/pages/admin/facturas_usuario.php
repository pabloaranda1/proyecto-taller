<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5">
  <h2 class="mb-4">Facturas de <?= esc($usuario['nombre']) ?> (ID #<?= esc($usuario['id_usuario']) ?>)</h2>

  <?php if (!empty($facturas)): ?>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Fecha</th>
          <th>Total</th>
          <th>Ver</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($facturas as $factura): ?>
          <tr>
            <td><?= esc($factura['id_factura']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($factura['fecha'])) ?></td>
            <td>$<?= number_format($factura['total'], 2, ',', '.') ?></td>
            <td>
              <a href="<?= site_url('factura/ver/' . $factura['id_factura']) ?>" class="btn btn-sm btn-outline-secondary" title="Ver factura">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No se encontraron facturas para este usuario.</p>
  <?php endif; ?>

  <a href="<?= previous_url() ?>" class="btn btn-outline-secondary mt-3">Volver</a>
</div>

<?= $this->endSection() ?>
