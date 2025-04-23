<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>
<h2 class="mb-4">Contacto</h2>
<p><strong>Nombre del Titular:</strong> Empresa Demo S.A.</p>
<p><strong>Razón Social:</strong> Empresa Demo Sociedad Anónima</p>
<p><strong>Domicilio Legal:</strong> Calle Ficticia 123, Ciudad, País</p>
<p><strong>Teléfonos:</strong> (011) 1234-5678</p>
<p><strong>Email:</strong> contacto@demo.com</p>
<p><strong>Redes Sociales:</strong> @demo en Instagram, Facebook</p>

<form>
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" placeholder="Tu nombre">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Correo Electrónico</label>
    <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com">
  </div>
  <div class="mb-3">
    <label for="mensaje" class="form-label">Mensaje</label>
    <textarea class="form-control" id="mensaje" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?= $this->endSection() ?>