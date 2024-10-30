// Este código asume que idUsuario ha sido definido en el HTML

console.log("ID de Usuario:", idUsuario); // Mostrará el ID de Usuario en la consola

// Array que contiene las preguntas sobre verbos en presente, pasado y futuro
const questions = [
    {
        question: "¿Cuál es la forma en pasado de 'go'?",
        answers: [
            { text: "Went", correct: true },
            { text: "Go", correct: false },
            { text: "Gone", correct: false },
            { text: "Going", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en futuro de 'eat'?",
        answers: [
            { text: "Will eat", correct: true },
            { text: "Ate", correct: false },
            { text: "Eaten", correct: false },
            { text: "Eat", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en presente de 'run'?",
        answers: [
            { text: "Run", correct: true },
            { text: "Ran", correct: false },
            { text: "Will run", correct: false },
            { text: "Running", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en pasado de 'have'?",
        answers: [
            { text: "Had", correct: true },
            { text: "Has", correct: false },
            { text: "Having", correct: false },
            { text: "Will have", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en futuro de 'speak'?",
        answers: [
            { text: "Will speak", correct: true },
            { text: "Spoke", correct: false },
            { text: "Speaking", correct: false },
            { text: "Speak", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en presente de 'write'?",
        answers: [
            { text: "Write", correct: true },
            { text: "Wrote", correct: false },
            { text: "Written", correct: false },
            { text: "Writing", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en pasado de 'take'?",
        answers: [
            { text: "Took", correct: true },
            { text: "Take", correct: false },
            { text: "Taken", correct: false },
            { text: "Taking", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en futuro de 'make'?",
        answers: [
            { text: "Will make", correct: true },
            { text: "Made", correct: false },
            { text: "Make", correct: false },
            { text: "Making", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en presente de 'swim'?",
        answers: [
            { text: "Swim", correct: true },
            { text: "Swam", correct: false },
            { text: "Swimming", correct: false },
            { text: "Swum", correct: false }
        ]
    },
    {
        question: "¿Cuál es la forma en pasado de 'see'?",
        answers: [
            { text: "Saw", correct: true },
            { text: "Seen", correct: false },
            { text: "See", correct: false },
            { text: "Seeing", correct: false }
        ]
    }
];

let currentQuestionIndex = 0; // Índice de la pregunta actual
let score = 0; // Puntuación del usuario

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
    resultElement.innerText = `Tu puntuación es ${score} de ${questions.length}`; // Mostrar puntuación

    // Enviar resultado al servidor
    const idLeccion = 2; // Aquí debes poner el id de la lección actual (ajusta según tu lógica)

    // Crear datos para enviar
    const data = {
        idUsuario: idUsuario,
        idLeccion: idLeccion,
        resultado: score
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
