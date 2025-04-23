<?= $this->extend('templates/base') ?>

<?= $this->section('content') ?>

<!-- Bloque de bienvenida -->
<section class="text-center py-5 px-3">
    <img src="<?= base_url('assets/images/logo-horizontal.png') ?>" alt="Logo de Jaema" class="img-fluid mb-4" style="max-height: 150px;">
  <h1 class="display-5 fw-bold">Bienvenida a Jaema</h1>
  <p class="lead mt-3">
    En <strong>Jaema</strong> celebramos la autenticidad y el estilo de cada mujer. Nuestra tienda ofrece una amplia gama de ropa femenina que se adapta a todos los momentos de tu vida: desde outfits deportivos y cómodos, hasta prendas elegantes para tus eventos más especiales.
  </p>
  <p class="mt-2">
    Ya sea que busques algo informal, casual, moderno o clásico, en Jaema encontrás lo que necesitás para sentirte vos misma. Nuestra misión es brindarte calidad, tendencia y comodidad en cada prenda.
  </p>
  <p class="mt-2 text-muted fst-italic">Estilo para cada día. Jaema, tu forma de vestir.</p>
</section>

<?= $this->endSection() ?>

