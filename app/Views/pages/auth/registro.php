
<?= $this->extend('templates/baseAuth') ?>
<?= $this->section('content') ?>

<div class="container d-flex align-items-center justify-content-center login-page">
  <div class="card shadow-sm p-4 login-card">

    <a href="<?= base_url('/login') ?>" class="btn btn-link position-absolute top-0 start-0 m-2 back-btn">
      <svg width="10" height="14" viewBox="0 0 18 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
      <line x1="16" y1="2" x2="2" y2="16" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
      <line x1="2" y1="16" x2="16" y2="30" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
  </svg>
    </a>

    <div class="text-center mb-3">
      <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" style="max-width: 120px;">
    </div>

    <h3 class="text-center mb-4">Registrarse</h3>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?> 

    <form action="<?= base_url('/registro') ?>" method="post">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" name="celular" class="form-control" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn">Registrarse</button>
      </div>
    </form>
    <div class="text-center mt-3">
      <small>¿Ya tienes una cuenta? <a href="<?= base_url('/login') ?>">Iniciar sesión</a></small>
    </div>
  </div>
</div>

<?= $this->endSection() ?>