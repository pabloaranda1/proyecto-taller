<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard Jaema</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ventas totales</h5>
                    <?php
                    $res = $conexion->query("SELECT SUM(total) as totalVentas FROM factura");
                    $data = $res->fetch_assoc();
                    echo "<p class='card-text'>$ " . number_format($data['totalVentas'], 2, ',', '.') . "</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Productos con stock bajo</h5>
                    <?php
                    $res = $conexion->query("SELECT COUNT(*) as pocosStock FROM producto WHERE stock < 5");
                    $data = $res->fetch_assoc();
                    echo "<p class='card-text'>" . $data['pocosStock'] . " productos</p>";
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Visitas activas</h5>
                    <p class="card-text">Simulado: <?php echo rand(1, 12); ?> usuarios</p>
                </div>
            </div>
        </div>
    </div>
</div>

