
<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Gestión de Productos</h1>
    
    <a href="<?= site_url('admin/productos/agregar') ?>" class="btn btn-success mb-3">Agregar producto</a>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= esc($p->id_producto) ?></td>
                    <td><?= esc($p->nombre) ?></td>
                    <td><?= esc($p->categoria) ?></td>
                    <td>$ <?= number_format($p->precio, 2, ',', '.') ?></td>
                    <td><?= esc($p->stock) ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
                        <a href="<?= site_url('admin/productos/eliminar/' . $p->id_producto) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>