
<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="<?= base_url('/') ?>">
      <img src="<?= base_url('assets/images/logo-horizontal.png') ?>" alt="Logo" height="40">
    </a>

    <!-- Botón Hamburguesa -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin"
      aria-controls="navbarNavAdmin" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú -->
    <div class="collapse navbar-collapse navbar-collapse-right" id="navbarNavAdmin">
      <!-- Opciones principales a la izquierda -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/admin') ?>">Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/admin/usuarios') ?>">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/admin/stock') ?>">Stock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/admin/pedidos') ?>">Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navbar-link-secondary" href="<?= base_url('/admin/consultas') ?>">Consultas</a>
        </li>
      </ul>

      <!-- Perfil a la derecha -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- Perfil -->
        <li class="nav-item dropdown position-relative mt-2 me-2">
          <a class="nav-link" href="#" id="adminUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20c0-4 8-4 8-4s8 0 8 4"/>
            </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminUserDropdown">
            <li><a class="dropdown-item" href="<?= base_url('/admin/perfil') ?>">Mi perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>