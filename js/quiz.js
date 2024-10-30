// quiz.js
// Este código asume que idUsuario ha sido definido en el HTML

console.log("ID de Usuario:", idUsuario); // Mostrará el ID de Usuario en la consola

// Array que contiene las preguntas y respuestas
const questions = [
    {
        question: "¿Cuál es la traducción de 'perro' en inglés?",
        answers: [
            { text: "Dog", correct: true },
            { text: "Cat", correct: false },
            { text: "Bird", correct: false },
            { text: "Fish", correct: false }
        ]
    },
    {
        question: "¿Qué significa 'casa' en inglés?",
        answers: [
            { text: "House", correct: true },
            { text: "Home", correct: false },
            { text: "Apartment", correct: false },
            { text: "Building", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'libro' en inglés?",
        answers: [
            { text: "Book", correct: true },
            { text: "Magazine", correct: false },
            { text: "Notebook", correct: false },
            { text: "Paper", correct: false }
        ]
    },
    {
        question: "¿Qué significa 'mesa' en inglés?",
        answers: [
            { text: "Table", correct: true },
            { text: "Chair", correct: false },
            { text: "Pencil", correct: false },
            { text: "Counter", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'manzana' en inglés?",
        answers: [
            { text: "Apple", correct: true },
            { text: "Banana", correct: false },
            { text: "Grape", correct: false },
            { text: "Orange", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'boy' en español?",
        answers: [
            { text: "Niño", correct: true },
            { text: "Hombre", correct: false },
            { text: "Chico", correct: false },
            { text: "Adulto", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'girl' en español?",
        answers: [
            { text: "Niña", correct: true },
            { text: "Mujer", correct: false },
            { text: "Chica", correct: false },
            { text: "Adulta", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'school' en español?",
        answers: [
            { text: "Escuela", correct: true },
            { text: "Universidad", correct: false },
            { text: "Colegio", correct: false },
            { text: "Instituto", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'teacher' en español?",
        answers: [
            { text: "Profesor", correct: true },
            { text: "Estudiante", correct: false },
            { text: "Maestro", correct: false },
            { text: "Compañero", correct: false }
        ]
    },
    {
        question: "¿Cuál es la traducción de 'friend' en español?",
        answers: [
            { text: "Amigo", correct: true },
            { text: "Conocido", correct: false },
            { text: "Compañero", correct: false },
            { text: "Vecino", correct: false }
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
    const idLeccion = 1; // Aquí debes poner el id de la lección actual (ajusta según tu lógica)

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
