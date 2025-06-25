<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 contacto-page">
  <h2 class="mb-5 text-center fade-in">Contacto</h2>

  <div class="row g-5 fade-in delay-1">

    <div class="col-md-6">
      <div class="p-4 border bg-white shadow-sm h-100">
        <h4 class="mb-4 text-secondary">Datos de Contacto</h4>
        <p><strong>Nombre del Titular:</strong><br> Ana Martinez</p>
        <p><strong>Razón Social:</strong><br> Empresa Jaema Sociedad Anónima</p>
        <p><strong>Domicilio:</strong><br> Guastavino 1901, Corrientes, CORRIENTES</p>
        <p><strong>Teléfonos:</strong><br> (011) 9 3764 222-396</p>
        <p><strong>Email:</strong><br> jaema.indumentaria@gmail.com</p>
        <p><strong>Redes Sociales:</strong><br> @jaema. en Instagram y Facebook</p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="ratio ratio-4x3 border shadow-sm bg-white">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14158.80585015307!2d-58.85378497706162!3d-27.478552085614346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456c96ddc466cb%3A0xc089f6ed31870545!2sDr.%20Guastavino%201901%2C%20W3410GAH%20Corrientes!5e0!3m2!1ses-419!2sar!4v1746035008345!5m2!1ses-419!2sar" 
          style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </div>

  <div class="row mt-5 fade-in delay-2">
    <div class="col-12">
      <div class="p-4 border bg-white shadow-sm">
        <h4 class="mb-4 text-secondary">Envíanos tu consulta</h4>
        <?php if (session('exito')): ?>
          <div class="alert alert-success mt-3"><?= session('exito') ?></div>
        <?php endif; ?>
        <?php if (session('error')): ?>
          <div class="alert alert-danger mt-3"><?= session('error') ?></div>
        <?php endif; ?>
        <form action="<?= site_url('consultas/enviar') ?>" method="post" id="form-consulta">
          <div class="row g-3">
            <?php if (!session('id_usuario')): ?>
              <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
              </div>
            <?php endif; ?>
            <div class="col-12">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>
            <div class="col-12 text-end">
              <button type="submit" class="btn btn-outline-dark mt-3">Enviar Mensaje</button>
              <div id="mensaje-exito" class="text-success mt-3 d-none">Correo enviado exitosamente.</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
