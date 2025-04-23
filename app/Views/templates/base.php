<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Tienda' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/inicio.css') ?>">
</head>
<body>

    <?= view('components/navbar') ?>

    <main class="container my-5">
        <?= $this->renderSection('content') ?>
    </main>

    <?= view('components/footer') ?>
    
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>