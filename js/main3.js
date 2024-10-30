document.addEventListener('DOMContentLoaded', function() {
    const words = [
        { word: 'PROGRAMMING', translation: 'PROGRAMACIÓN' },
        { word: 'DEVELOPMENT', translation: 'DESARROLLO' },
        { word: 'JAVASCRIPT', translation: 'JAVASCRIPT' },
        { word: 'WEB', translation: 'WEB' },
        { word: 'COMPUTER', translation: 'COMPUTADORA' },
        { word: 'FUNCTION', translation: 'FUNCIÓN' },
        { word: 'VARIABLE', translation: 'VARIABLE' },
        { word: 'OBJECT', translation: 'OBJETO' },
        { word: 'ARRAY', translation: 'ARREGLO' },
        { word: 'LOOP', translation: 'BUCLE' }
    ]; // Lista de palabras con sus traducciones
    let selectedWord = '';
    let attempts = 5;

    function startGame() {
        const randomIndex = Math.floor(Math.random() * words.length);
        selectedWord = words[randomIndex].word;
        document.getElementById('wordDisplay').innerText = scrambleWord(selectedWord);
        document.getElementById('attemptsDisplay').innerText = `Intentos restantes: ${attempts}`;
        document.getElementById('guessInput').value = '';
    }

    function scrambleWord(word) {
        return word.split('').sort(() => Math.random() - 0.5).join('');
    }

    function checkGuess() {
        const guess = document.getElementById('guessInput').value.toUpperCase();
        if (guess === selectedWord) {
            Swal.fire('¡Correcto!', 'Has adivinado la palabra.', 'success').then(startGame);
        } else {
            attempts--;
            if (attempts <= 0) {
                Swal.fire('Juego Terminado', `La palabra era "${selectedWord}".`, 'error').then(startGame);
            } else {
                document.getElementById('attemptsDisplay').innerText = `Intentos restantes: ${attempts}`;
                Swal.fire('Incorrecto', 'Intenta de nuevo.', 'error');
            }
        }
    }

    document.getElementById('guessButton').addEventListener('click', checkGuess);
    
    document.getElementById('helpButton').addEventListener('click', () => {
        const translation = words.find(wordObj => wordObj.word === selectedWord).translation; // Encuentra la traducción
        Swal.fire({
            title: 'La pista es:',
            text: translation,
            icon: 'info',
            confirmButtonText: 'OK'
        });
    });

    document.getElementById('exitButton').addEventListener('click', function () {
        Swal.fire({
            title: '¿Estás seguro de que deseas salir?',
            text: `La palabra era "${selectedWord}".`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Opcional: redirige a la página principal o recarga para resetear el juego
                window.location.href = 'index.php'; // Cambia la ruta si es necesario
                // O usa esta línea si solo quieres reiniciar la interfaz:
                // window.location.reload();
            }
        });
    });
    

    startGame(); // Inicia el juego cuando se carga la página
});
