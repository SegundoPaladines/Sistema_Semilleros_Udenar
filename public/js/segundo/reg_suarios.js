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

        if (aceptacion) {
            modalIcono.classList.add('fas', 'fa-check-circle', 'text-success', 'modal-icono-aceptacion', 'fa-5x');
            modalExito.classList.add('modal-aceptacion');
            btnCerrarModal1.classList.add('btn-success');
        } else {
            modalIcono.classList.add('fas', 'fa-times-circle', 'text-danger', 'modal-icono-rechazo', 'fa-5x');
            modalExito.classList.add('modal-rechazo');
            btnCerrarModal1.classList.add('btn-danger');
        }

        modalExito.classList.add('show');
        modalExito.style.display = 'block';

        btnCerrarModal1.addEventListener('click', function() {
            modalExito.style.display = 'none';
        });

        btnCerrarModal2.addEventListener('click', function() {
            modalExito.style.display = 'none';
        });

    }
}

//Comprobación de los campos en tiempo real 
document.addEventListener('DOMContentLoaded', function() {
    const nombreInput = document.getElementById('nombre');
    const nombreError = document.getElementById('nombre-e');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-e');
    const passwd1Input = document.getElementById('passwd1');
    const passwd1Error = document.getElementById('passwd1-e');
    const passwd2Input = document.getElementById('passwd2');
    const passwd2Error = document.getElementById('passwd2-e');
    const rolSelect = document.getElementById('rol');
    const rolError = document.getElementById('rol-e');
    const btns = document.getElementById('btn-submit');

    btns.disabled = !areAllFieldsValid();
    
    nombreInput.addEventListener('input', function(event) {
        const nombreValue = nombreInput.value.trim();
        const nombreRegex = /^[A-Za-zñÑ\s]+$/;

        if (nombreValue.length === 0) {
            nombreError.textContent = 'El nombre es obligatorio.';
            nombreError.classList.add('d-block');
            nombreInput.classList.add('is-invalid');
        } else if (!nombreValue.match(nombreRegex)) {
            nombreError.textContent = 'Ingrese únicamente letras y espacios.';
            nombreError.classList.add('d-block');
            nombreInput.classList.add('is-invalid');
        } else if (nombreValue.length < 2) {
            nombreError.textContent = 'El nombre debe tener al menos 2 caracteres.';
            nombreError.classList.add('d-block');
            nombreInput.classList.add('is-invalid');
        } else if (nombreValue.length > 50) {
            nombreError.textContent = 'El nombre no puede tener más de 50 caracteres.';
            nombreError.classList.add('d-block');
            nombreInput.classList.add('is-invalid');
        } else {
            nombreError.textContent = ''; // Borrar el mensaje de error si la validación es exitosa
            nombreError.classList.remove('d-block'); // Ocultar el div de error
            nombreInput.classList.remove('is-invalid'); // Quitar la clase de resaltado de error
        }
        btns.disabled = !areAllFieldsValid();
    });

    emailInput.addEventListener('input', async function(event) {
        const emailValue = event.target.value;

        if (!emailValue) {
            emailError.textContent = 'El campo correo es obligatorio.';
            emailError.classList.add('d-block');
            emailInput.classList.add('is-invalid');
        } else if (!isValidEmail(emailValue)) {
            emailError.textContent = 'El correo debe ser válido.';
            emailError.classList.add('d-block');
            emailInput.classList.add('is-invalid');
        } else if (!emailValue.endsWith('@udenar.edu.co')) {
            emailError.textContent = 'El correo debe terminar en @udenar.edu.co';
            emailError.classList.add('d-block');
            emailInput.classList.add('is-invalid');
        } else {
            const isRegistered = await isEmailRegistered(emailValue);
    
            if (isRegistered) {
                emailError.textContent = 'El correo ya está registrado.';
                emailError.classList.add('d-block');
                emailInput.classList.add('is-invalid');
            }else {
                        emailError.textContent = ''; // Borrar el mensaje de error si todo es válido
                        emailError.classList.remove('d-block');
                        emailInput.classList.remove('is-invalid');
            }
        }
        btns.disabled = !areAllFieldsValid();
    });

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
            passwd2Error.textContent = 'La contraseña es obligatoria.';
            passwd2Error.classList.add('d-block');
            passwd2Input.classList.add('is-invalid');
        } else if (passwd2Value !== passwd1Value) {
            passwd2Error.textContent = 'Las contraseñas no coinciden.';
            passwd2Error.classList.add('d-block');
            passwd2Input.classList.add('is-invalid');
        } else {
            passwd2Error.textContent = ''; // Borrar el mensaje de error si todo es válido
            passwd2Error.classList.remove('d-block');
            passwd2Input.classList.remove('is-invalid');
        }
        btns.disabled = !areAllFieldsValid();
    });

    rolSelect.addEventListener('click', function(event) {
        const selectedValue = event.target.value;

        if (selectedValue) {
            rolError.textContent = ''; // Borrar el mensaje de error si se seleccionó una opción
        } else {
            rolError.textContent = 'Seleccione una opción.';
        }

        btns.disabled = !areAllFieldsValid();
    });

    function areAllFieldsValid() {
        return (
            nombreError.textContent === '' &&
            emailError.textContent === '' &&
            passwd1Error.textContent === '' &&
            passwd2Error.textContent === '' &&
            rolError.textContent === ''
        );
    }
    
    // Funciones para el emailInput.addEventListener 
    // Función para validar el formato de correo electrónico
    function isValidEmail(email) {
        const emailRegex = /^[a-zA-ZñÑ0-9._%+-]+@[a-zA-ZñÑ0-9.-]+\.[a-zA-ZñÑ]{2,}$/
        return emailRegex.test(email);
    }

    // Función para verificar si el correo electrónico ya está registrado (simulado)
    function isEmailRegistered(email) {
        return fetch(`/check-email/${email}`)
            .then(response => response.json())
            .then(data => {
                return data.exists;
            })
            .catch(error => {
                console.error(error);
                return false;
            });
    }
    
});
