
  function mostrarTooltip() {
    const tooltip = document.getElementById('tooltipCarrito');
    tooltip.classList.add('show');

    setTimeout(() => {
      tooltip.classList.remove('show');
    }, 2000); // se oculta después de 2 segundos
  }


  document.addEventListener("DOMContentLoaded", function () {
    // Función para hacer scroll suave
    function smoothScrollToHash() {
      const hash = window.location.hash;
      if (hash) {
        const target = document.querySelector(hash);
        if (target) {
          setTimeout(() => {
            target.scrollIntoView({ behavior: 'smooth' });
          }, 300); // tiempo para asegurar que todo está cargado
        }
      }
    }

    // Llamada inicial por si ya está el hash
    smoothScrollToHash();

    // También se puede volver a llamar si cambia el hash (opcional)
    window.addEventListener('hashchange', smoothScrollToHash);
  });

  document.addEventListener("DOMContentLoaded", function () {
    const formulario = document.querySelector("form");
    const mensajeExito = document.getElementById("mensaje-exito");


      // Validación simple (podés ajustarla si querés)
      const campos = formulario.querySelectorAll("input, textarea, select");
      let formularioValido = true;

      campos.forEach(campo => {
        if (campo.hasAttribute("required") && !campo.value.trim()) {
          formularioValido = false;
        }
      });

      // Mostrar mensaje y limpiar campos si todo está completo
      if (formularioValido) {
        mensajeExito.classList.remove("d-none");
        mensajeExito.classList.add("fade-in");

        // Limpiar los campos
        formulario.reset();

        // Ocultar el mensaje luego de 3 segundos (opcional)
        setTimeout(() => {
          mensajeExito.classList.add("d-none");
        }, 3000);
      }
    });
