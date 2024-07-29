document.addEventListener('DOMContentLoaded', function() {
    const patrones = {
        nombre: /^[A-Za-z\s]{2,22}$/,
        correo: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        telefono: /^\d{12}$/,
        precio: /^\d+(\.\d{1,2})?$/
    };

    function validarEntrada(input, patron) {
        if (patron.test(input.value)) {
            input.classList.remove('invalido');
            input.classList.add('valido');
        } else {
            input.classList.remove('valido');
            input.classList.add('invalido');
        }
    }

    document.querySelectorAll('.patron-nombre').forEach(input => {
        input.addEventListener('input', function() {
            validarEntrada(input, patrones.nombre);
        });
    });

    document.querySelectorAll('.patron-correo').forEach(input => {
        input.addEventListener('input', function() {
            validarEntrada(input, patrones.correo);
        });
    });

    document.querySelectorAll('.patron-telefono').forEach(input => {
        input.addEventListener('input', function() {
            validarEntrada(input, patrones.telefono);
        });
    });

    document.querySelectorAll('.patron-precio').forEach(input => {
        input.addEventListener('input', function() {
            validarEntrada(input, patrones.precio);
        });
    });

    document.querySelectorAll('input[required]').forEach(input => {
        input.classList.add('requerido');
    });

    document.querySelectorAll('input:not([required])').forEach(input => {
        input.classList.add('opcional');
    });
});
// Ejemplo de como puedes ponerlo en html
// class="patron-nombre requerido"