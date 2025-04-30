<?= $this->extend('templates/base') ?>
<?= $this->section('content') ?>

<div class="container py-5 quienes-somos-page">

  <h2 class="mb-5 text-center fade-in">Quiénes somos</h2>

  <div class="row mb-5 fade-in delay-1">
    <div class="col-12 col-md-6">
      <h4 class="text-secondary mb-3">Nuestra Historia</h4>
      <p>
        ¡Hola! Soy Ana Martínez, la persona detrás de Jaema.  
        Siempre me gustó la moda, el estilo y la idea de ayudar a otras personas a sentirse bien con lo que usan.
      </p>
      <p>
        En 2022 decidí animarme y empezar este proyecto por mi cuenta.  
        Jaema nació como un emprendimiento personal, en el que me ocupo de todo: elegir la ropa, hablar con mayoristas, armar los pedidos, atender cada mensaje y preparar cada envío.
      </p>
      <p>
        Elijo ropa que me gustaría usar a mí: cómoda, actual, de buena calidad y accesible. Cada pieza que ves en la tienda fue elegida por mí pensando en vos.
      </p>
    </div>
    <div class="col-12 col-md-6 text-center">
      <img src="<?= base_url('assets/images/ana-foto.jpg') ?>" alt="Foto de Ana Martínez" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
    </div>
  </div>

  <div class="row mb-5 fade-in delay-2">
    <div class="col-12">
      <h4 class="text-secondary mb-3">Qué ofrecemos</h4>
      <p>
        En Jaema vas a encontrar ropa de todo tipo: casual, deportiva, para salir, para estar cómoda en casa o para trabajar.  
        Mi idea es ofrecer variedad, calidad y buenos precios, sin perder el trato cercano que me encanta tener con cada cliente.
      </p>
      <ul>
        <li>Prendas actuales para todas las edades</li>
        <li>Estilos variados: cómodos, modernos y funcionales</li>
        <li>Selección personal de ropa comprada a mayoristas de confianza</li>
        <li>Atención directa y personalizada: siempre vas a hablar conmigo</li>
      </ul>
      <p>
        Me encargo de cada detalle con dedicación, desde la elección de la mercadería hasta el empaquetado final. Todo lo hago con mucho amor.
      </p>
    </div>
  </div>

  <div class="row fade-in delay-3 align-items-center">
    <div class="col-md-4 text-center">
      <img src="<?= base_url('assets/images/ana-foto.jpg') ?>" alt="Ana Martínez" class="img-fluid rounded-circle shadow-sm" style="width: 200px; height: 200px; object-fit: cover;">
    </div>
    <div class="col-md-8">
      <h5 class="text-secondary mt-4 mt-md-0">Ana Martínez</h5>
      <p><strong>Fundadora y única persona a cargo de Jaema</strong></p>
      <p>
        Emprender sola no es fácil, pero es un camino que disfruto mucho. Cada paso que doy, lo hago con esfuerzo y con la ilusión de seguir creciendo.
      </p>
      <p>
        Gracias por tomarte el tiempo de conocerme. Si llegaste hasta acá, ojalá te animes a formar parte de esta comunidad linda que se va armando de a poco.
      </p>
      <p class="fst-italic text-muted">
        “Elegir qué ponernos también es una forma de cuidarnos.”
      </p>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
