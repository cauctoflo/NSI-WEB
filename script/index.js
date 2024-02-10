const textElement = document.getElementById('text');
const texts = ['Quizz', 'Porsches', 'PorschaQuiz'];
const cursorElement = document.querySelector('.cursor');

let textIndex = 0;
let index = 0;
let isDeleting = false;

function type() {
    const currentText = textElement.innerHTML;

    if (isDeleting) {
        textElement.innerHTML = currentText.slice(0, -1);
        index--;

        if (index === 0) {
            isDeleting = false;

            setTimeout(() => {
                textElement.innerHTML = '';
                textIndex = (textIndex + 1) % texts.length;
                type();
            }, 1000);
        } else {
            setTimeout(type, 50);
        }
    } else {
        textElement.innerHTML = texts[textIndex].slice(0, index + 1);
        index++;

        if (index > texts[textIndex].length) {
            isDeleting = true;
            setTimeout(type, 1000);
        } else {
            setTimeout(type, 150);
        }
    }
}

function blinkCursor() {
    cursorElement.classList.toggle('hidden');
}

setInterval(blinkCursor, 900);
type();