<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container my-5 consulta-detalle">

    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">Consulta #<?= esc($consulta['id_consulta']) ?></h5>
        </div>

        <div class="card-body">

            <div class="mb-3">
                <strong>Nombre:</strong>
                <?= esc($consulta['nombre'] ?? 'Usuario no disponible') ?>
            </div>

            <?php if (isset($consulta['email'])): ?>
            <div class="mb-3">
                <strong>Email:</strong>
                <?= esc($consulta['email']) ?>
            </div>
            <?php endif; ?>

            <div class="mb-4">
                <strong>Mensaje:</strong>
                <div class="border rounded p-3 bg-light" style="min-height: 150px;">
                    <?= nl2br(esc($consulta['mensaje'])) ?>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= site_url($rutaToggleLeido . '/' . $consulta['id_consulta']) ?>"
                   class="btn <?= $consulta['leido'] ? 'btn-secondary' : 'btn-success' ?>">
                   <?= $consulta['leido'] ? 'Marcar como no leído' : 'Marcar como leído' ?>
                </a>

                <a href="<?= site_url('admin/consultas') ?>" class="btn btn-outline-dark">← Volver a Consultas</a>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
