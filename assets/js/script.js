
document.addEventListener("DOMContentLoaded", function () {

    // Smooth scroll
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

    // Edición de campos en el perfil del usuario
    document.querySelectorAll('.editar-campo').forEach(boton => {
        boton.addEventListener('click', () => {
            const campo = boton.getAttribute('data-campo');
            const input = document.querySelector(`input[name="${campo}"]`);
            input.removeAttribute('readonly');
            input.focus();

            if (campo === 'password') {
                document.getElementById('confirmar-password-group').classList.remove('d-none');
            }

            document.getElementById('btn-guardar').disabled = false;
        });
    });

    // Guardado del formulario del perfil
    const form = document.getElementById('form-editar-usuario');
    const tick = document.getElementById('tick-guardado');
    if (form && tick) {
        form.addEventListener('submit', function (e) {
            if (!confirm('¿Estás seguro de que deseas guardar los cambios?')) {
                e.preventDefault();
                return;
            }
            tick.classList.remove('d-none');
            setTimeout(() => {
                tick.classList.add('d-none');
                form.submit(); // Envía el formulario después de 1 segundo
            }, 1000);
        });
    }

    // Tooltips Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Estado de consultas (admin)
    document.querySelectorAll('.toggle-leido').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.dataset.id;
            const tipo = btn.dataset.tipo;

            const res = await fetch(`/admin/consultas/estadoajax/${tipo}/${id}`, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await res.json();

            if (data.status === 'ok') {
                btn.textContent = data.label;
                btn.title = data.tooltip;
                btn.classList.toggle('btn-success', data.nuevoEstado == 1);
                btn.classList.toggle('btn-secondary', data.nuevoEstado == 0);
            } else {
                alert('Error al cambiar el estado');
            }
        });
    });



});

function mostrarToast(mensaje, tipo = 'success') {
  const toastEl = document.getElementById('toastCarrito');
  const toastMsg = document.getElementById('toastCarritoMensaje');

  toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
  toastEl.classList.add('bg-' + tipo);
  toastMsg.textContent = mensaje;

  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

let csrfName = '<?= csrf_token() ?>';
let csrfHash = '<?= csrf_hash() ?>';

document.addEventListener('DOMContentLoaded', function () {
  // Mostrar el selector de cantidad al hacer clic
  document.querySelectorAll('.add-to-cart-link').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      // Ocultar otros selectores abiertos
      document.querySelectorAll('.quantity-selector').forEach(sel => sel.classList.add('d-none'));

      const parent = this.closest('.product-card');
      const selector = parent.querySelector('.quantity-selector');
      if (selector) {
        selector.classList.remove('d-none');
      }
      const disponible = parseInt(this.getAttribute('data-disponible')) || 1;
        const input = selector.querySelector('.cantidad-input');
        input.max = disponible;
        if (parseInt(input.value) > disponible) {
          input.value = disponible;
      }
    });
  });

  // Botones + y -
  document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.addEventListener('click', function () {
      const input = this.parentElement.querySelector('.cantidad-input');
      const max = parseInt(input.max);
      if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
    });
  });

  document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.addEventListener('click', function () {
      const input = this.parentElement.querySelector('.cantidad-input');
      if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    });
  });

  // Confirmar agregar al carrito
  document.querySelectorAll('.btn-confirmar').forEach(btn => {
    btn.addEventListener('click', function () {
      const selector = this.closest('.quantity-selector');
      const productId = selector.dataset.productId;
      const cantidad = parseInt(selector.querySelector('.cantidad-input').value);
      const max = parseInt(selector.dataset.stock);

      if (isNaN(cantidad) || cantidad < 1 || cantidad > max) {
        mostrarToast('Cantidad inválida ❌', 'danger');
        return;
      }

      const xhr = new XMLHttpRequest();
      xhr.open('POST', carritoUrl, true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function () {
        console.log('Respuesta servidor:', xhr.responseText);
        if (xhr.status === 200) {
          try {
            const res = JSON.parse(xhr.responseText);
            if (res.status === 'success') {
              mostrarToast('Producto agregado al carrito ✅', 'success');
              selector.classList.add('d-none');

              if (res.status === 'success') {
                mostrarToast('Producto agregado al carrito ✅', 'success');
                selector.classList.add('d-none');

                // 🔄 ACTUALIZAR stock disponible
                const newDisponible = parseInt(selector.dataset.stock) - cantidad;
                selector.dataset.stock = newDisponible;
                selector.querySelector('.cantidad-input').max = newDisponible;

                // También actualizamos el data-stock del botón "Añadir"
                const addToCartBtn = document.querySelector(`.add-to-cart-link[data-product-id="${productId}"]`);
                if (addToCartBtn) {
                  addToCartBtn.dataset.disponible = newDisponible;
                }

                // Actualizamos el token CSRF si viene nuevo
                if (res.csrfName && res.csrfHash) {
                  csrfName = res.csrfName;
                  csrfHash = res.csrfHash;
                }
              }

              // Actualizar token CSRF si viene nuevo
              if (res.csrfName && res.csrfHash) {
                csrfName = res.csrfName;
                csrfHash = res.csrfHash;
              }
            } else {
              mostrarToast(res.message || 'No se pudo agregar', 'danger');
            }
          } catch (e) {
            mostrarToast('Respuesta inesperada del servidor', 'danger');
          }
        } else if (xhr.status === 403) {
          mostrarToast('Debés iniciar sesión primero ⚠️', 'danger');
        } else {
          mostrarToast('Error al agregar ❌', 'danger');
        }
      };

      xhr.onerror = function () {
        mostrarToast('Error de red ❌', 'danger');
      };

      xhr.send(
        'id_producto=' + encodeURIComponent(productId) +
        '&cantidad=' + encodeURIComponent(cantidad) +
        '&' + encodeURIComponent(csrfName) + '=' + encodeURIComponent(csrfHash)
      );
    });
  });

  // Ocultar el selector al hacer clic fuera
  document.addEventListener('click', function (event) {
    const isInsideSelector = event.target.closest('.quantity-selector');
    const isAddLink = event.target.closest('.add-to-cart-link');
    if (!isInsideSelector && !isAddLink) {
      document.querySelectorAll('.quantity-selector').forEach(sel => sel.classList.add('d-none'));
    }
  });
});

