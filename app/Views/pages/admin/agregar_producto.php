
<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container mt-4 admin-form" style="max-width: 500px;">
    <h2>Agregar Producto</h2>
    <form action="<?= site_url('admin/productos/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-2">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control form-control-sm" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-control form-control-sm" required>
                <option value="">Selecciona una categoría</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>
        <div class="mb-2">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control form-control-sm" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control form-control-sm" required>
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