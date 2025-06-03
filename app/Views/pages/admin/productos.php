
<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Gestión de Productos</h1>
    
    <a href="#" class="btn btn-success mb-3">Agregar producto</a>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM producto";
            $resultado = $conexion->query($query);
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$fila['id_producto']}</td>";
                echo "<td>{$fila['nombre']}</td>";
                echo "<td>{$fila['desc']}</td>";
                echo "<td>{$fila['categoria']}</td>";
                echo "<td>$ {$fila['precio']}</td>";
                echo "<td>{$fila['stock']}</td>";
                echo "<td>" . ($fila['activo'] ? 'Sí' : 'No') . "</td>";
                echo "<td>
                        <a href='#' class='btn btn-sm btn-primary'>Editar</a>
                        <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?= $this->endSection() ?>