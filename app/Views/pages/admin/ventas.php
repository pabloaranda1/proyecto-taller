<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Listado de Ventas</h1>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Factura</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT f.id_factura, u.nombre, f.fecha, f.total
                    FROM factura f
                    JOIN usuario u ON f.id_usuario = u.id_usuario
                    ORDER BY f.fecha DESC";
            $res = $conexion->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_factura']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['fecha']}</td>
                        <td>$ {$row['total']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
