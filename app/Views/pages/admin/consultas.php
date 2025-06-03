
<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Consultas de Usuarios</h1>

    <h4>🟢 Con sesión iniciada</h4>
    <table class="table table-bordered table-sm mb-5">
        <thead class="table-success">
            <tr>
                <th>Usuario</th>
                <th>Mensaje</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT u.nombre, c.mensaje, c.activo
                    FROM consulta c
                    JOIN usuario u ON c.id_usuario = u.id_usuario";
            $res = $conexion->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['mensaje']}</td>
                        <td>" . ($row['activo'] ? 'Sí' : 'No') . "</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <h4>🔵 Sin sesión iniciada</h4>
    <table class="table table-bordered table-sm">
        <thead class="table-info">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM consulta_sin_sesion";
            $res = $conexion->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['mensaje']}</td>
                        <td>" . ($row['activo'] ? 'Sí' : 'No') . "</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>