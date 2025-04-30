<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 comercializacion-page" style="background-color: #f8f9fa; max-width: 1100px; padding-top: 60px; padding-bottom: 60px;">

  <div class="text-center mb-10 fade-in">
    <h1 class="mb-4 fs-2">Todo lo que necesitás saber sobre tu compra</h1>
    <p class="lead fs-5 mb-3">
      En nuestra tienda trabajamos cada día para que tu experiencia sea simple, segura y agradable. <br>
      Te ofrecemos distintas alternativas de entrega, envío y pago para que puedas elegir la que mejor se adapte a tus necesidades.
    </p>
    <p class="lead fs-5">
      Nos comprometemos a brindarte un servicio rápido, confiable y de calidad desde el primer clic hasta que tengas tu pedido en las manos. <br>
      ¡Gracias por confiar en nosotros!
    </p>
  </div>

  <!-- Bloque: Entregas -->
  <section class="py-10 my-10 fade-in">
    <h2 class="mb-4 text-center fs-3">Entregas</h2>
    <div class="row g-4">

      <!-- Entrega a domicilio -->
      <div class="col-12 col-md-6 fade-in delay-1">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body p-4 text-center">
            <img src="<?= base_url('assets/images/entrega-a-domicilio.png') ?>" alt="A domicilio" style="width: 50px;" class="mb-3">
            <h5 class="card-title mb-3 fs-5">Entrega a Domicilio</h5>
            <p class="fs-6">Recibí tus compras en la comodidad de tu hogar en un plazo de 24 a 72 horas hábiles.</p>
            <p class="fs-6">Coordinamos entregas rápidas y seguras.</p>
          </div>
        </div>
      </div>

      <!-- Retiro en tienda -->
      <div class="col-12 col-md-6 fade-in delay-2">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body p-4 text-center">
            <img src="<?= base_url('assets/images/tienda.png') ?>" alt="Retiro en tienda" style="width: 50px;" class="mb-3">
            <h5 class="card-title mb-3 fs-5">Retiro en Tienda</h5>
            <p class="fs-6">Podés retirar tu compra en nuestro local en horario comercial.</p>
            <p class="fs-6">Te avisaremos apenas esté listo para que lo retires.</p>
            <ul class="list-unstyled mt-3 fs-6">
              <li>• <strong>Mañana:</strong> 9:00 a 13:00 hs</li>
              <li>• <strong>Tarde:</strong> 16:00 a 20:00 hs</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </section>

  <hr class="my-10" style="border: none; height: 2px; background-color: #ccc;">

  <!-- Bloque: Envíos -->
  <section class="py-10 my-10 fade-in">
    <h2 class="mb-4 text-center fs-3">Envíos</h2>
    <div class="card shadow-sm border-0 mx-auto" style="max-width: 650px;">
      <div class="card-body p-4 text-center">
        <img src="<?= base_url('assets/images/delivery.png') ?>" alt="Envíos" style="width: 50px;" class="mb-3">
        <h5 class="card-title mb-3 fs-5">Envíos a Todo el País</h5>
        <p class="fs-6">Realizamos envíos rápidos y seguros a través de empresas certificadas:</p>
        <ul class="list-unstyled mt-3 fs-6">
          <li>• <a href="https://www.oca.com.ar/" target="_blank" rel="noopener noreferrer">OCA</a></li>
          <li>• <a href="https://www.andreani.com/" target="_blank" rel="noopener noreferrer">Andreani</a></li>
          <li>• <a href="https://www.correoargentino.com.ar/" target="_blank" rel="noopener noreferrer">Correo Argentino</a></li>
        </ul>
        <p class="mt-3 fs-6">Recibirás tu número de seguimiento para consultar el estado de tu pedido en tiempo real.</p>
      </div>
    </div>
  </section>

  <hr class="my-10" style="border: none; height: 2px; background-color: #ccc;">

  <!-- Bloque: Formas de Pago -->
  <section class="py-10 my-10 fade-in">
    <h2 class="mb-4 text-center fs-3">Formas de Pago</h2>
    <div class="row g-4">

      <!-- Tarjetas -->
      <div class="col-12 col-md-4 fade-in delay-1">
        <div class="card h-100 shadow-sm border-0 text-center">
          <div class="card-body p-4">
            <img src="<?= base_url('assets/images/tarjeta-de-credito.png') ?>" alt="Tarjetas" style="width: 50px;" class="mb-3">
            <h5 class="card-title mb-3 fs-5">Tarjetas</h5>
            <ul class="list-unstyled fs-6">
              <li>• Visa</li>
              <li>• Mastercard</li>
            </ul>
            <p class="mt-3 fs-6">Pagá en un pago o en cuotas seleccionadas.</p>
          </div>
        </div>
      </div>

      <!-- Transferencias -->
      <div class="col-12 col-md-4 fade-in delay-2">
        <div class="card h-100 shadow-sm border-0 text-center">
          <div class="card-body p-4">
            <img src="<?= base_url('assets/images/transferencia.png') ?>" alt="Transferencia" style="width: 50px;" class="mb-3">
            <h5 class="card-title mb-3 fs-5">Transferencias</h5>
            <ul class="list-unstyled fs-6">
              <li>• <strong>Mercado Pago</strong></li>
              <li>• <strong>Cuenta DNI</strong></li>
              <li>• <strong>Transferencia Bancaria</strong></li>
            </ul>
            <p class="mt-3 fs-6">Transferí fácilmente desde tu billetera virtual o banco y envíanos el comprobante.</p>
          </div>
        </div>
      </div>

      <!-- Efectivo -->
      <div class="col-12 col-md-4 fade-in delay-3">
        <div class="card h-100 shadow-sm border-0 text-center">
          <div class="card-body p-4">
            <img src="<?= base_url('assets/images/efectivo.png') ?>" alt="Efectivo" style="width: 50px;" class="mb-3">
            <h5 class="card-title mb-3 fs-5">Efectivo</h5>
            <p class="fs-6">Pagá en efectivo al momento de retirar tu compra en nuestra tienda física.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>

<?= $this->endSection() ?>
