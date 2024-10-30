function startGame(difficulty) {
    Swal.fire({
        title: `Iniciar juego en modo ${difficulty.charAt(0).toUpperCase() + difficulty.slice(1)}`,
        text: `Has seleccionado el nivel ${difficulty}.`,
        icon: 'info',
        confirmButtonText: 'Aceptar'
    }).then(() => {
        switch (difficulty) {
            case 'facil':
                window.location.href = 'nivel1.php';
                break;
            case 'medio':
                window.location.href = 'nivel2.php';
                break;
            case 'dificil':
                window.location.href = 'nivel3.php';
                break;
            default:
                window.location.href = 'lecciones.php';
                break;
        }
    });
}
function showHelp() {
    Swal.fire({
        title: 'Welcome',
        text: 'Bienvenido a LinguiPro. Aquí podrás practicar tu inglés en los niveles.',
        icon: 'info',
        confirmButtonText: 'OK'
    });
}

