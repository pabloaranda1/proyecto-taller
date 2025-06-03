
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="<?= base_url('/') ?>">
      <img src="<?= base_url('assets/images/logo-horizontal.png') ?>" alt="Logo" height="40">
    </a>

    <!-- Botón Hamburguesa -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú -->
    <div class="collapse navbar-collapse navbar-collapse-right" id="navbarNav">
      <!-- Opciones principales a la izquierda -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="catalogoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catálogo
          </a>
          <ul class="dropdown-menu dropdown-menu-responsive" aria-labelledby="catalogoDropdown">
            <li><a class="dropdown-item" href="<?= base_url('/catalogo-verano') ?>">Verano</a></li>
            <li><a class="dropdown-item" href="<?= base_url('/catalogo-invierno') ?>">Invierno</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('/') ?>#productCarousel">Destacados 🔥</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/contacto') ?>">Contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/quienes-somos') ?>">Quiénes Somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/comercio') ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/terminos') ?>">Términos y Usos</a>
        </li>
      </ul>

      <!-- Carrito y perfil a la derecha -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- Carrito -->
        <li class="nav-item position-relative mt-2 me-2">
          <a href="javascript:void(0);" class="nav-link" onclick="mostrarTooltip()">
            <img src="<?= base_url('assets/images/carrito.png') ?>" alt="Carrito" height="24">
          </a>
          <div id="tooltipCarrito" class="carrito-tooltip">En construcción</div>
        </li>
        <!-- Perfil -->
        <li class="nav-item dropdown position-relative mt-2 me-2">
          <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
            <circle cx="12" cy="8" r="4"/>
            <path d="M4 20c0-4 8-4 8-4s8 0 8 4"/>
            </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <?php if (session()->get('id_usuario')): ?>
              <li><a class="dropdown-item" href="javascript:void(0);">Mi perfil</a></li>
              <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Cerrar sesión</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="<?= base_url('/login') ?>">Iniciar sesión</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>