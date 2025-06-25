<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="text-left mb-5">
        <h1 class="mb-3"><?= esc($titulo) ?></h1>
        <p class="lead">
            <?php if (strpos(strtolower($titulo), 'invierno') !== false): ?>
                Descubrí nuestra colección de invierno, diseñada para combinar estilo y confort en los días fríos.
            <?php elseif (strpos(strtolower($titulo), 'verano') !== false): ?>
                Explorá nuestra colección de verano, pensada para lucir cómodo y fresco en cualquier ocasión.
            <?php else: ?>
                Conocé nuestras últimas prendas de moda.
            <?php endif; ?>
        </p>
    </div>

    <div class="row">
        <?php foreach ($productos as $producto): ?>
            <div class="col-12 col-md-4 mb-4">
                <div class="card product-card">
                    <img src="<?= base_url('assets/images/productos/' . $producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="img-fluid">
                    <div class="background-overlay" style="background-image: url('<?= base_url('assets/images/productos-background/' . $producto['imagen2']) ?>');"></div>
                    <div class="card-body z-2 position-relative">
                        <h5 class="card-title"><?= esc($producto['nombre']) ?></h5>
                        <p class="card-label">Stock: <?= esc($producto['stock']) ?></p>
                        <p class="card-price">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                        <?php
                        $yaEnCarrito = $itemsEnCarrito[$producto['id_producto']] ?? 0;
                        $stockDisponible = max(0, $producto['stock'] - $yaEnCarrito);
                        ?>
                        <a href="#" class="add-to-cart-link"
                        data-product-id="<?= esc($producto['id_producto']) ?>"
                        data-stock="<?= esc($producto['stock']) ?>"
                        data-disponible="<?= esc($stockDisponible) ?>">Añadir al carrito</a>

                        <div class="quantity-selector d-none mt-2"
                            data-product-id="<?= esc($producto['id_producto']) ?>"
                            data-stock="<?= esc($stockDisponible) ?>">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                <input type="number" class="form-control text-center cantidad-input"
                                    value="1" min="1" max="<?= esc($stockDisponible) ?>">
                                <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                <button class="btn btn-success btn-confirmar ms-2">✔</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Toast container -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="toastCarrito" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastCarritoMensaje">
        Producto añadido correctamente
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>

<script>
  const carritoUrl = '<?= site_url('carrito/agregar') ?>';
</script>
<script src="<?= base_url('assets/js/tu-archivo.js') ?>"></script>

<?= $this->endSection() ?>
