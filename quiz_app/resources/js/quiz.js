$(document).ready(function(){
    let answer = {};
    $(".question_option .option").on("click", function(){
        let $currentQuestion = $(this).closest(".question_box");
        let value = Number($(this).find("input").val());
        let questionId = $currentQuestion.data("id");

        answer[questionId] = value;

        $currentQuestion.find(".option").removeClass("active");
        $(this).addClass("active");

        const $nextQuestion = $currentQuestion.next(".question_box");

        if($nextQuestion.length){
            $("html, body").animate({
                scrollTop: $nextQuestion.offset().top + 10
            }, 400);
        }
        // }else if(!$nextQuestion){
        //     $("html, body").amimate({
        //         scrollTop: $(".question_submit").offset().top - 550
        //     }, 400)
        // }
    });

    $(".question_submit").on("click", function(e){
        e.preventDefault();
        let $allQuestion = $(".question_box");
        
        let unansweredQuestion = null;
        
        $allQuestion.each(function(){
            let questionId = $(this).data("id");
            
            if(!answer.hasOwnProperty(questionId)){
                unansweredQuestion = $(this);
                return false;
            }
        });

        if(unansweredQuestion){
            $("html, body").animate({
                scrollTop: unansweredQuestion.offset().top - 50
            }, 400);

        }else{
            $(".question_submit").prop("disabled", true);
            $("#form")[0].submit();
        }
    })
})