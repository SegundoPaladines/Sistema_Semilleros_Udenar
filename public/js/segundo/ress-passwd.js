function mostrarAlertaRegistroExitoso(mensaje, titulo, aceptacion) {
    var modalExito = document.getElementById('reg_ext_emergente');
    var modalTitulo = document.getElementById('modal-titulo');
    var modalMensaje = document.getElementById('modalExitoMensaje');
    var modalIcono = document.getElementById('modal-icono');
    var btnCerrarModal1 = document.getElementById('btnCerrarModal');
    var btnCerrarModal2 = document.getElementById('cerrar-modal'); 

    if (modalExito) {
      modalTitulo.textContent = titulo;
      modalMensaje.textContent = mensaje;

      modalIcono.classList.add('fas', 'fa-check-circle', 'text-success', 'modal-icono-aceptacion', 'fa-5x');
      modalExito.classList.add('modal-aceptacion');
      btnCerrarModal1.classList.add('btn', 'btn-success');

      modalExito.classList.add('show');
      modalExito.style.display = 'block';

      btnCerrarModal1.addEventListener('click', function() {
        window.location.href = 'home';
      });

      btnCerrarModal2.addEventListener('click', function() {
        window.location.href = 'home';
      });
    }
}

//Comprobación de los campos en tiempo real 
document.addEventListener('DOMContentLoaded', function() {
  const passwd1Input = document.getElementById('passwd1');
  const passwd1Error = document.getElementById('passwd1-e');
  const passwd2Input = document.getElementById('passwd2');
  const passwd2Error = document.getElementById('passwd2-e');
  const passwd3Input = document.getElementById('passwd3');
  const passwd3Error = document.getElementById('passwd3-e');
  const btns = document.getElementById('btn-submit');

  btns.disabled = !areAllFieldsValid();

  passwd1Input.addEventListener('input', function(event) {
    const passwd1Value = event.target.value;

    if (!passwd1Value) {
        passwd1Error.textContent = 'La contraseña es obligatoria.';
        passwd1Error.classList.add('d-block');
        passwd1Input.classList.add('is-invalid');
    } else if (passwd1Value.length < 6) {
        passwd1Error.textContent = 'La contraseña debe tener al menos 6 caracteres.';
        passwd1Error.classList.add('d-block');
        passwd1Input.classList.add('is-invalid');
    } else {
        passwd1Error.textContent = ''; // Borrar el mensaje de error si todo es válido
        passwd1Error.classList.remove('d-block');
        passwd1Input.classList.remove('is-invalid');
    }
    btns.disabled = !areAllFieldsValid();
  });

  passwd2Input.addEventListener('input', function(event) {
      const passwd2Value = event.target.value;
      const passwd1Value = passwd1Input.value;

      if (!passwd2Value) {
          passwd2Error.textContent = 'Este campo es obligatorio.';
          passwd2Error.classList.add('d-block');
          passwd2Input.classList.add('is-invalid');
      } else if (passwd2Value === passwd1Value) {
          passwd2Error.textContent = 'La nueva contraseña no debe ser la misma.';
          passwd2Error.classList.add('d-block');
          passwd2Input.classList.add('is-invalid');
      } else {
          passwd2Error.textContent = ''; // Borrar el mensaje de error si todo es válido
          passwd2Error.classList.remove('d-block');
          passwd2Input.classList.remove('is-invalid');
      }
      btns.disabled = !areAllFieldsValid();
  });

  passwd3Input.addEventListener('input', function(event) {
      const passwd3Value = event.target.value;
      const passwd2Value = passwd2Input.value;

      if (!passwd3Value) {
          passwd3Error.textContent = 'Este campo es obligatorio.';
          passwd3Error.classList.add('d-block');
          passwd3Input.classList.add('is-invalid');
      } else if (passwd3Value !== passwd2Value) {
          passwd3Error.textContent = 'Las contraseñas no coinciden.';
          passwd3Error.classList.add('d-block');
          passwd3Input.classList.add('is-invalid');
      } else {
          passwd3Error.textContent = ''; // Borrar el mensaje de error si todo es válido
          passwd3Error.classList.remove('d-block');
          passwd3Input.classList.remove('is-invalid');
      }
      btns.disabled = !areAllFieldsValid();
  });

  function areAllFieldsValid() {
    return (
        passwd1Error.textContent === '' &&
        passwd2Error.textContent === '' &&
        passwd3Error.textContent === ''
    );
  }

});