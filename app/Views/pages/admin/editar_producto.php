<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Editar Producto</h2>

    <form action="<?= site_url('admin/productos/actualizar/' . $producto->id_producto) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?= esc($producto->nombre) ?>" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" id="categoria" class="form-control" value="<?= esc($producto->categoria) ?>" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="<?= esc($producto->precio) ?>" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="s
