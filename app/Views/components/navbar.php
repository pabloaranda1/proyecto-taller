<nav class="navbar navbar-expand-lg navbar-light bg-white position-relative">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="<?= base_url('/') ?>">
      <img src="<?= base_url('assets/images/logo-horizontal.png') ?>" alt="Logo" height="40">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Izquierda: Menú -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            Catálogo
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Verano</a></li>
            <li><a class="dropdown-item" href="#">Invierno</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Destacados &#x1F525</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Centro: Barra de búsqueda -->
    <div class="search-wrapper">
      <form class="d-flex search-form">
        <input class="form-control me-2 custom-input" type="search" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-custom" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>
