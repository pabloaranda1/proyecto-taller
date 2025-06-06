<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Panel de administrador</h1>
    <div class="row">
        <!-- Ventas totales -->
        <div class="col-md-4">
    <div class="card text-bg-primary mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Ventas totales</h5>
                <form method="get" action="<?= base_url('/admin') ?>">
                    <select name="filtro" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="total" <?= $filtro === 'total' ? 'selected' : '' ?>>Total</option>
                        <option value="año" <?= $filtro === 'año' ? 'selected' : '' ?>>Este año</option>
                        <option value="mes" <?= $filtro === 'mes' ? 'selected' : '' ?>>Este mes</option>
                    </select>
                </form>
            </div>
            <p class="card-text mt-2">$ <?= number_format($totalVentas, 2, ',', '.') ?></p>
        </div>
    </div>
</div>


        <!-- Productos con stock bajo -->
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Productos con stock bajo</h5>
                    <p class="card-text"><?= $pocosStock ?> productos</p>
                </div>
            </div>
        </div>

        <!-- Usuarios registrados -->
        <div class="col-md-4">
            <div class="card text-bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuarios registrados</h5>
                    <p class="card-text"><?= $totalUsuarios ?> usuarios</p>
                </div>
            </div>
        </div>

        <!-- Productos totales por categoría -->
<div class="col-md-4">
    <div class="card text-bg-secondary mb-3">
        <div class="card-body">
            <h5 class="card-title">Productos en catálogo</h5>
            <p class="card-text">
                Total: <?= $totalProductos ?> productos<br>
                <?php foreach ($productosPorCategoria as $item): ?>
                    <?= ucfirst($item->categoria) ?>: <?= $item->cantidad ?><br>
                <?php endforeach; ?>
            </p>
        </div>
    </div>
</div>


        <!-- Productos más vendidos -->
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Producto más vendido</h5>
                    <p class="card-text"><?= $productoMasVendido ?? 'Sin datos' ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas ventas -->
    <h3 class="mt-5">Últimas ventas</h3>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ultimasVentas as $venta): ?>
                <tr>
                    <td><?= $venta->id_factura ?></td>
                    <td><?= $venta->fecha ?></td>
                    <td>$ <?= number_format($venta->total, 2, ',', '.') ?></td>
                    <td><?= $venta->cliente ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
