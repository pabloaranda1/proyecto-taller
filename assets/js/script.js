
  function mostrarTooltip() {
    const tooltip = document.getElementById('tooltipCarrito');
    tooltip.classList.add('show');

    setTimeout(() => {
      tooltip.classList.remove('show');
    }, 2000); 
  }


  document.addEventListener("DOMContentLoaded", function () {
    function smoothScrollToHash() {
      const hash = window.location.hash;
      if (hash) {
        const target = document.querySelector(hash);
        if (target) {
          setTimeout(() => {
            target.scrollIntoView({ behavior: 'smooth' });
          }, 300); 
        }
      }
    }


    smoothScrollToHash();

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

      if (formularioValido) {
        mensajeExito.classList.remove("d-none");
        mensajeExito.classList.add("fade-in");

        formulario.reset();
          
        setTimeout(() => {
          mensajeExito.classList.add("d-none");
        }, 3000);
      }
    });
