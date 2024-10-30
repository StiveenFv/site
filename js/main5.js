function startGame(nombreLeccion) {
    Swal.fire({
        title: `Iniciar juego en la lección ${nombreLeccion.charAt(0).toUpperCase() + nombreLeccion.slice(1)}`,
        text: `Has seleccionado la lección: ${nombreLeccion}.`,
        icon: 'info',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) { // Comprobar si se confirmó
            // Redirigir según la lección seleccionada
            switch (nombreLeccion) {
                case 'Leccion 1':
                    window.location.href = 'leccion1.php';
                    break;
                case 'Leccion 2':
                    window.location.href = 'leccion2.php';
                    break;
                case 'Leccion 3':
                    window.location.href = 'leccion3.php';
                    break;
                // Añade más casos según sea necesario
                default:
                    window.location.href = 'lecciones.php'; // Redirigir a lecciones si no hay coincidencia
                    break;
            }
        }
    });
}
