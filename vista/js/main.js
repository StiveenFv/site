let btn_Ingresar = document.getElementById('btn_Ingresar');
let usuario = document.getElementById('txt_Email');
let contrasena = document.getElementById('txt_Contrasena');

btn_Ingresar.addEventListener('click', () => {
    usuario = document.getElementById('txt_Email').value;
    contrasena = document.getElementById('txt_Contrasena').value;
    
    if (usuario === '' || contrasena === '') {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Usuario o Contraseña no pueden estar vacíos",
            footer: '<a href="#">¿Necesitas ayuda?</a>'
        });
    } else if (usuario === 'usuario_correcto' && contrasena === 'contrasena_correcta') { // Ajusta los valores según tu base de datos
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Bienvenido",
            showConfirmButton: false,
            timer: 5000
        });

        window.location.href = 'inicio.html';
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Usuario o Contraseña Incorrectos",
            footer: '<a href="#">¿Necesitas ayuda?</a>'
        });
    }
});

