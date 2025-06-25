<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 exito-compra-container">
  <div class="card-exito">
    <h2 class="text-success">¡Gracias por tu compra!</h2>
    <p>Tu pedido ha sido procesado exitosamente.</p>
    <p>Pronto recibirás novedades sobre el estado de tu pedido.</p>

    <a href="<?= site_url('/') ?>" class="btn btn-success btn-minimalista mt-4">Volver al inicio</a>
  </div>
</div>

<?= $this->endSection() ?>
