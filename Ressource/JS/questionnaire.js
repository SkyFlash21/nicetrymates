
let correctAnswers = 0;
let totalQuestions = 4;
let currentQuestion = 1;

    function nextQuestion() {
        // Zoom sur la première scene
        $(`#question${currentQuestion}`).animate({
            "font-size": "48px",
            opacity: 0
        }, 1000, function () {
            //  cache la scene actuel et reset le style
            $(this).hide().css({"font-size": "24px", opacity: 1});
            
            // change la scene a la prochaine
            currentQuestion++;
            if (currentQuestion > 3) {
                window.location.href = 'file:///C:/Users/foata/Documents/GitHub/nicetrymates/View/Dashboard.html';
            }


            // affiche la prochaine scene en zoomant
            $(`#question${currentQuestion}`).show().css({
                "font-size": "1px",
                opacity: 0
            }).animate({
                "font-size": "24px",
                opacity: 1
            }, 1000);
        });
    }

function checkAnswer(selectedAnswer){
    if (selectedAnswer == 1){
        correctAnswers++;
        console.log("Bonne réponse");
    }
    else if (selectedAnswer == 3){
        correctAnswers++;
    }
    else if (selectedAnswer == 5){
        correctAnswers++;
    }
    else {
        console.log("Mauvaise réponse");
    }

let progress = (correctAnswers/totalQuestions)*100;
document.getElementById("progress-bar").style.width = progress + "%";
document.getElementById("progress-bar").innerText = Math.round(progress) + "%";
}