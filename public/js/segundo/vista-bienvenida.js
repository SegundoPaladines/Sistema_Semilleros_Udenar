document.addEventListener('DOMContentLoaded', function() {
    const login = document.querySelector("#vtn-login");
  
    window.onclick = function(event) {
        if (event.target === login) {
          login.close();
        }
    }

    const email = document.getElementById('email');
    const contra = document.getElementById('password');
    const texto = document.getElementById('texto-email');
    const texto_pass = document.getElementById('texto-pass');
    const btnLogin = document.getElementById('bt-login');

    const email_reg = /^[a-zA-Z0-9._-]+@udenar\.edu\.co$/;

    var email_valido = false;

    email.addEventListener('blur', () => {
        if (email_reg.test(email.value)) {
            texto.style.display = 'none';
            email_valido = true;
            validarFormulario();
        } else {
            texto.style.display = 'block';
            email_valido = false;
            validarFormulario();
        }
    });
    contra.addEventListener('blur', () => {
        if (contra.value.trim() !== '') {
            contra.classList.remove('invalid');
            contra.classList.add('valid');
            texto_pass.style.display='none';
        } else {
            contra.classList.remove('valid');
            contra.classList.add('invalid');
            texto_pass.style.display = 'block';
        }
    });

    var input_contra = document.getElementById('password');
    var vercontra = document.getElementById('ver-contra');
    var icono_ver_contra = document.getElementById('icono-ver-contra');

    vercontra.addEventListener('click', function() {
        if (input_contra.type === 'password') {
            input_contra.type = 'text';
            icono_ver_contra.classList.remove('fa-eye');
            icono_ver_contra.classList.add('fa-eye-slash');
        } else {
            input_contra.type = 'password';
            icono_ver_contra.classList.remove('fa-eye-slash');
            icono_ver_contra.classList.add('fa-eye');
        }
    });

    function validarFormulario() {
        if (email_valido) {
            btnLogin.disabled = false;
        } else {
            btnLogin.disabled = true;
        }
    }

    function validarCamposContinuamente() {
        if (email_reg.test(email.value)) {
            email.classList.remove('invalid');
            email.classList.add('valid');
            email_valido = true;
            validarFormulario();
        } else {
            email.classList.remove('valid');
            email.classList.add('invalid');
            email_valido = false;
            validarFormulario();
        }
    }

    setInterval(validarCamposContinuamente, 500);
});
