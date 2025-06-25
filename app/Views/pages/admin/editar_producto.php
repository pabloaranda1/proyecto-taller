<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4 admin-form" style="max-width: 500px;">
    <h2>Editar Producto</h2>

    <?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/productos/actualizar/' . $producto->id_producto) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-2">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control form-control-sm" value="<?= old('nombre', esc($producto->nombre)) ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-control form-control-sm" required>
                <option value="">Selecciona una categoría</option>
                <option value="Invierno" <?= old('categoria', $producto->categoria) == 'Invierno' ? 'selected' : '' ?>>Invierno</option>
                <option value="Verano" <?= old('categoria', $producto->categoria) == 'Verano' ? 'selected' : '' ?>>Verano</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Precio</label>
            <input type="number" step="1000" name="precio" class="form-control form-control-sm" value="<?= old('precio', esc($producto->precio)) ?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control form-control-sm" value="<?= old('stock', esc($producto->stock)) ?>" required>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label class="form-label">Imagen 1 (opcional)</label>
                <input type="file" name="imagen" class="form-control form-control-sm" accept="image/*">
            </div>
            <div class="col">
                <label class="form-label">Imagen 2 (opcional)</label>
                <input type="file" name="imagen2" class="form-control form-control-sm" accept="image/*">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
        <a href="<?= site_url('admin/productos') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
