const words = [
    { word: 'Revolution', translation: 'Revolución', image: 'imagenes/revolution.jpg' },
    { word: 'Close', translation: 'Cerrar', image: 'imagenes/cerrar.jpg' },
    { word: 'Boy', translation: 'Niño', image: 'imagenes/niño.jpg' },
    { word: 'Enjoyed', translation: 'Disfrutado', image: 'imagenes/disfrutar.jpg' },
    { word: 'Remember', translation: 'Recordar', image: 'imagenes/recordar.jpg' },
    { word: 'Blue', translation: 'Azul', image: 'imagenes/azul.jpg' }
];

let selectedWordObject = words[Math.floor(Math.random() * words.length)];
let selectedWord = selectedWordObject.word.toLowerCase();
let displayWord = '_'.repeat(selectedWord.length);
let attempts = 6;

const wordDisplay = document.getElementById('wordDisplay');
const guessInput = document.getElementById('guessInput');
const guessButton = document.getElementById('guessButton');
const attemptsDisplay = document.getElementById('attemptsDisplay');
const exitButton = document.getElementById('exitButton');
const wordImage = document.getElementById('wordImage'); // Obtener referencia a la imagen

// Mostrar la imagen correspondiente a la palabra seleccionada
function updateWordImage() {
    wordImage.src = selectedWordObject.image;  // Cambiar la imagen a la correspondiente
    wordImage.style.display = 'block';  // Mostrar la imagen
}

function updateDisplayWord(letter) {
    let newDisplayWord = '';
    for (let i = 0; i < selectedWord.length; i++) {
        newDisplayWord += (selectedWord[i] === letter) ? letter : displayWord[i];
    }
    displayWord = newDisplayWord;
    wordDisplay.textContent = displayWord;
}

function checkGameStatus() {
    if (!displayWord.includes('_')) {
        Swal.fire({
            title: '¡Felicidades!',
            text: `Has adivinado la palabra. Traducción: ${selectedWordObject.translation}`,
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
        return true;
    } else if (attempts <= 0) {
        Swal.fire({
            title: '¡Juego terminado!',
            text: `La palabra era "${selectedWord}". Traducción: ${selectedWordObject.translation}`,
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return true;
    }
    return false;
}

wordDisplay.textContent = displayWord;
updateWordImage();  // Mostrar la imagen al inicio del juego

guessButton.addEventListener('click', () => {
    const guess = guessInput.value.toLowerCase();
    guessInput.value = '';
    
    if (guess.length === 1 && /^[a-z]$/.test(guess)) {
        if (selectedWord.includes(guess)) {
            updateDisplayWord(guess);
        } else {
            attempts--;
        }
        
        attemptsDisplay.textContent = `Intentos restantes: ${attempts}`;
        
        if (checkGameStatus()) {
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    } else {
        Swal.fire({
            title: 'Error',
            text: 'Ingresa una letra válida.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
});

exitButton.addEventListener('click', () => {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres salir del juego?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, salir',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php';
        }
    });
});