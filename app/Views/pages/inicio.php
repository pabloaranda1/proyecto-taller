<?= $this->extend('templates/base') ?>

<?= $this->section('content') ?>

<!-- Bloque de bienvenida -->
<div class="fade-in">
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
</div>

<!-- Carrusel de productos -->
<section class="py-5">
    <h2 class="text-center mb-4">Productos Destacados</h2>
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod01.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 1">
                        <h5>Producto 1</h5>
                        <p class="small text-muted">Descripción corta del producto 1.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod05.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 2">
                        <h5>Producto 2</h5>
                        <p class="small text-muted">Descripción corta del producto 2.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod09.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 3">
                        <h5>Producto 3</h5>
                        <p class="small text-muted">Descripción corta del producto 3.</p>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod04.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 4">
                        <h5>Producto 4</h5>
                        <p class="small text-muted">Descripción corta del producto 4.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod07.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 5">
                        <h5>Producto 5</h5>
                        <p class="small text-muted">Descripción corta del producto 5.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod25.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 6">
                        <h5>Producto 6</h5>
                        <p class="small text-muted">Descripción corta del producto 6.</p>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod17.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 7">
                        <h5>Producto 7</h5>
                        <p class="small text-muted">Descripción corta del producto 7.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod30.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 8">
                        <h5>Producto 8</h5>
                        <p class="small text-muted">Descripción corta del producto 8.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('assets/images/productos/prod08.jpg') ?>" class="d-block w-100 product-img mb-2" alt="Producto 9">
                        <h5>Producto 9</h5>
                        <p class="small text-muted">Descripción corta del producto 9.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Botones de navegación -->
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

    </div>
</section>

<?= $this->endSection() ?>