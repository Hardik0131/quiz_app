$(document).ready(()=>{
    
    let answers = {}
    $(".question_option .option").on("click", function(e){
        e.preventDefault();

        let $currentQuestion = $(this).closest(".question_box");
        let value = Number($(this).val());
        let questionIndex = $currentQuestion.data("id");
        // let count = 0;

        // count += value

        // console.log(count);
        answers[questionIndex] = value;

        $currentQuestion.find(".option").removeClass("active");
        $(this).addClass("active");

        const $nextQuestion = $currentQuestion.next(".question_box");
        if($nextQuestion.length){
            $("html, body").animate({
                scrollTop:$nextQuestion.offset().top - 50
            }, 400);
        }

        let total = Object.values(answers).reduce((a, b)=> a + b, 0);
        console.log(total);

        // console.log(answers);
    })

    $(".question_submit").on("click", function(e){
        e.preventDefault();

        let $allQuestion = $(".question_box");
        let unansweredQuestion = null;

        $allQuestion.each(function(){
            let questionId = $(this).data("id");

            if(!answers.hasOwnProperty(questionId)){
                unansweredQuestion = $(this);
                return false;
            }
        })

        if(unansweredQuestion){
            $("html, body").animate({
                scrollTop:unansweredQuestion.offset().top - 50,
            }, 400);

            unansweredQuestion.addClass("unaswered_question")
            return;
        }

        console.log(`All answers : ${answers}`);
    })
})