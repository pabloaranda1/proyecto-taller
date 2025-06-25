
<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4 admin-form" style="max-width: 500px;">
    <h2>Agregar Producto</h2>
    <?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/productos/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control form-control-sm" value="<?= old('nombre')?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-control form-control-sm" required>
                <option value="">Selecciona una categoría</option>
                <option value="Invierno">Invierno</option>
                <option value="Verano">Verano</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Precio</label>
            <input type="number" step="1000" name="precio" class="form-control form-control-sm" value="<?= old('precio')?>" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control form-control-sm" value="<?= old('stock')?>" required>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label class="form-label">Imagen 1</label>
                <input type="file" name="imagen" class="form-control form-control-sm" accept="image/*" required>
            </div>
            <div class="col">
                <label class="form-label">Imagen 2</label>
                <input type="file" name="imagen2" class="form-control form-control-sm" accept="image/*" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
        <a href="<?= site_url('admin/productos') ?>" class="btn btn-secondary btn-sm">Cancelar</a>
    </form>
</div>
<?= $this->endSection() ?>