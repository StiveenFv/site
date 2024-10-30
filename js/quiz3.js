// quiz.js
// Este código asume que idUsuario ha sido definido en el HTML

console.log("ID de Usuario:", idUsuario); // Mostrará el ID de Usuario en la consola

// Array que contiene las preguntas y respuestas sobre comparativos y superlativos
const questions = [
    {
        question: "¿Cuál es la forma comparativa de 'big'?",
        answers: [
            { text: "Bigger", correct: true },
            { text: "Biggest", correct: false },
            { text: "Big", correct: false },
            { text: "More big", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma superlativa de 'fast'?",
        answers: [
            { text: "Fastest", correct: true },
            { text: "Faster", correct: false },
            { text: "Most fast", correct: false },
            { text: "More fast", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma comparativa de 'good'?",
        answers: [
            { text: "Better", correct: true },
            { text: "Gooder", correct: false },
            { text: "Best", correct: false },
            { text: "Goodest", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma superlativa de 'bad'?",
        answers: [
            { text: "Worst", correct: true },
            { text: "Worse", correct: false },
            { text: "Baddest", correct: false },
            { text: "More bad", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma comparativa de 'happy'?",
        answers: [
            { text: "Happier", correct: true },
            { text: "Happiest", correct: false },
            { text: "More happy", correct: false },
            { text: "Most happy", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma superlativa de 'small'?",
        answers: [
            { text: "Smallest", correct: true },
            { text: "Smaller", correct: false },
            { text: "Most small", correct: false },
            { text: "More small", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma comparativa de 'far'?",
        answers: [
            { text: "Farther", correct: true },
            { text: "Furthest", correct: false },
            { text: "More far", correct: false },
            { text: "Most far", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma superlativa de 'easy'?",
        answers: [
            { text: "Easiest", correct: true },
            { text: "Easier", correct: false },
            { text: "More easy", correct: false },
            { text: "Most easy", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma comparativa de 'expensive'?",
        answers: [
            { text: "More expensive", correct: true },
            { text: "Most expensive", correct: false },
            { text: "Expensiver", correct: false },
            { text: "Expensivest", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma superlativa de 'beautiful'?",
        answers: [
            { text: "Most beautiful", correct: true },
            { text: "More beautiful", correct: false },
            { text: "Beautifullest", correct: false },
            { text: "Beautifulest", correct: false }
        ]
    }
];

let currentQuestionIndex = 0; // Índice de la pregunta actual
let score = 0; // Puntuación del usuario

// Definir el umbral de aprobación
const passingScore = 0.6; // 60%

// Elementos del DOM
const questionContainer = document.getElementById('question-container');
const questionElement = document.getElementById('question');
const answerButtons = document.getElementById('answer-buttons');
const nextButton = document.getElementById('next-button');
const finishButton = document.getElementById('finish-button');
const resultContainer = document.getElementById('result-container');
const resultElement = document.getElementById('result');

// Función para iniciar la prueba
function startQuiz() {
    currentQuestionIndex = 0; // Reiniciar índice de pregunta
    score = 0; // Reiniciar puntuación
    nextButton.style.display = 'none'; // Ocultar botón de siguiente
    finishButton.style.display = 'none'; // Ocultar botón de finalizar
    resultContainer.style.display = 'none'; // Ocultar contenedor de resultados
    questionContainer.style.display = 'block'; // Mostrar contenedor de preguntas
    showQuestion(questions[currentQuestionIndex]); // Mostrar la primera pregunta
}

// Función para mostrar una pregunta
function showQuestion(question) {
    questionElement.innerText = question.question; // Mostrar texto de la pregunta
    answerButtons.innerHTML = ''; // Limpiar botones de respuesta
    question.answers.forEach(answer => {
        const button = document.createElement('button'); // Crear un nuevo botón
        button.innerText = answer.text; // Establecer el texto del botón
        button.classList.add('btn', 'btn-light'); // Añadir clases de Bootstrap
        button.addEventListener('click', () => selectAnswer(answer)); // Añadir evento de clic
        answerButtons.appendChild(button); // Añadir botón al contenedor de respuestas
    });
}

// Función para seleccionar una respuesta
function selectAnswer(answer) {
    if (answer.correct) {
        score++; // Incrementar puntuación si la respuesta es correcta
    }
    currentQuestionIndex++; // Avanzar al siguiente índice de pregunta
    nextButton.style.display = 'block'; // Mostrar botón de siguiente
    // Si es la última pregunta, ocultar el botón de siguiente y mostrar el de finalizar
    if (currentQuestionIndex === questions.length - 1) {
        nextButton.style.display = 'none';
        finishButton.style.display = 'block';
    }
}

// Evento para el botón de siguiente
nextButton.addEventListener('click', () => {
    showQuestion(questions[currentQuestionIndex]); // Mostrar la siguiente pregunta
    nextButton.style.display = 'none'; // Ocultar botón de siguiente
});

// Evento para el botón de finalizar
finishButton.addEventListener('click', () => {
    questionContainer.style.display = 'none'; // Ocultar preguntas
    resultContainer.style.display = 'block'; // Mostrar resultados

    // Calcular el porcentaje de respuestas correctas
    const percentage = score / questions.length;

    // Verificar si el usuario aprobó o no
    const passed = percentage >= passingScore;

    // Mostrar puntuación y mensaje de aprobación o reprobación
    resultElement.innerText = `Tu puntuación es ${score} de ${questions.length}. ` +
                              (passed ? "¡Felicidades, has aprobado!" : "Lo siento, no has aprobado.");

    // Enviar resultado al servidor
    const idLeccion = 3; // ID de la lección de adjetivos comparativos y superlativos

    // Crear datos para enviar
    const data = {
        idUsuario: idUsuario,
        idLeccion: idLeccion,
        resultado: score,
        aprobado: passed // Enviar también si aprobó o no
    };

    // Enviar datos usando fetch
    fetch('php/insertar_resultado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Resultado guardado con éxito');
        } else {
            console.error('Error al guardar el resultado:', data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});

// Iniciar la prueba al cargar el script
startQuiz();
