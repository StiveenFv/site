document.addEventListener('DOMContentLoaded', function () {
    const words = [
        { spanish: 'animal', english: 'animal' },
        { spanish: 'jardín', english: 'garden' },
        { spanish: 'puerta', english: 'door' },
        { spanish: 'ventana', english: 'window' },
        { spanish: 'pelota', english: 'ball' },
        { spanish: 'película', english: 'movie' },
        { spanish: 'libro', english: 'book' },
        { spanish: 'silla', english: 'chair' },
        { spanish: 'espejo', english: 'mirror' },
        { spanish: 'computadora', english: 'computer' },
        { spanish: 'televisión', english: 'television' },
        { spanish: 'coche', english: 'car' },
        { spanish: 'cuaderno', english: 'notebook' },
        { spanish: 'cielo', english: 'sky' },
        { spanish: 'tierra', english: 'earth' }
    ];

    let attemptsRemaining = 5; // Número de intentos restantes

    const getRandomWords = (correctWord) => {
        let options = [correctWord];
        while (options.length < 4) {
            const randomWord = words[Math.floor(Math.random() * words.length)].english;
            if (!options.includes(randomWord)) {
                options.push(randomWord);
            }
        }
        return options.sort(() => Math.random() - 0.5);
    };

    const updateAttemptsDisplay = () => {
        document.getElementById('attemptsDisplay').textContent = `Intentos restantes: ${attemptsRemaining}`;
    };

    const displayWord = () => {
        if (attemptsRemaining <= 0) {
            Swal.fire({
                title: 'Juego terminado',
                text: '¡Has agotado todos los intentos!',
                icon: 'info',
                confirmButtonText: 'Volver a intentarlo'
            }).then(() => {
                attemptsRemaining = 5; // Reinicia los intentos
                updateAttemptsDisplay();
                // No llamar a displayWord() aquí, para evitar mostrar una nueva palabra inmediatamente
            });
            return;
        }

        const word = words[Math.floor(Math.random() * words.length)];
        document.getElementById('wordDisplay').textContent = word.spanish;
        const options = getRandomWords(word.english);
        const optionsContainer = document.getElementById('options');
        optionsContainer.innerHTML = '';
        options.forEach(option => {
            const button = document.createElement('button');
            button.className = 'btn btn-custom option-button'; // Incluye la clase .option-button
            button.textContent = option;
            button.addEventListener('click', () => checkAnswer(option, word.english));
            optionsContainer.appendChild(button);
        });
        
    };

    const checkAnswer = (selectedOption, correctAnswer) => {
        if (selectedOption === correctAnswer) {
            Swal.fire({
                title: '¡Correcto!',
                text: '¡Bien hecho!',
                icon: 'success',
                confirmButtonText: 'Siguiente'
            }).then(() => {
                displayWord();
            });
        } else {
            attemptsRemaining--;
            updateAttemptsDisplay();
            Swal.fire({
                title: 'Incorrecto',
                text: 'Inténtalo de nuevo',
                icon: 'error',
                confirmButtonText: 'Intentar de nuevo'
            });
        }
    };

    document.getElementById('exitButton').addEventListener('click', () => {
        window.location.href = 'index.php';
    });

    updateAttemptsDisplay();
    displayWord();
});
