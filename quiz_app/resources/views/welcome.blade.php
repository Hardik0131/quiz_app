<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hardik</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/quiz.css', 'resources/js/quiz.js'])

</head>

<body>
    <div class="main_container">
        <form action="" method="POST" id="form">
            @csrf
            <div class="question_container">
                <div class="question_box" data-id="1">
                    <div class="question_number">
                        <h3>Q.1 <span class="question_seprater">/ <span>5</span></span></h3>
                    </div>
                    <div class="image_container">
                        <img src="images/image1.png" alt="">
                    </div>
                    <div class="question">
                        <h1>Which one you choose ?</h1>
                    </div>
                    <div class="question_option">
                        <button class="option" value="1">Option A</button>
                        <button class="option" value="2">Option B</button>
                        <button class="option" value="3">Option C</button>
                        <button class="option" value="4">Option D</button>
                    </div>
                </div>
                <div class="question_box" data-id="2">
                    <div class="question_number">
                        <h3>Q.2 <span class="question_seprater">/ <span>5</span></span></h3>
                    </div>
                    <div class="image_container">
                        <img src="images/image2.png" alt="">
                    </div>
                    <div class="question">
                        <h1>Which one you choose ?</h1>
                    </div>
                    <div class="question_option">
                        <button class="option" value="1">Option A</button>
                        <button class="option" value="2">Option B</button>
                        <button class="option" value="3">Option C</button>
                        <button class="option" value="4">Option D</button>
                    </div>
                </div>
                <div class="question_box" data-id="3">
                    <div class="question_number">
                        <h3>Q.3 <span class="question_seprater">/ <span>5</span></span></h3>
                    </div>
                    <div class="image_container">
                        <img src="images/image3.png" alt="">
                    </div>
                    <div class="question">
                        <h1>Which one you choose ?</h1>
                    </div>
                    <div class="question_option">
                        <button class="option" value="1">Option A</button>
                        <button class="option" value="2">Option B</button>
                        <button class="option" value="3">Option C</button>
                        <button class="option" value="4">Option D</button>
                    </div>
                </div>
                <div class="question_box" data-id="4">
                    <div class="question_number">
                        <h3>Q.4 <span class="question_seprater">/ <span>5</span></span></h3>
                    </div>
                    <div class="image_container">
                        <img src="images/image4.png" alt="">
                    </div>
                    <div class="question">
                        <h1>Which one you choose ?</h1>
                    </div>
                    <div class="question_option">
                        <button class="option" value="1">Option A</button>
                        <button class="option" value="2">Option B</button>
                        <button class="option" value="3">Option C</button>
                        <button class="option" value="4">Option D</button>
                    </div>
                </div>
                <div class="question_box" data-id="5">
                    <div class="question_number">
                        <h3>Q.5 <span class="question_seprater">/ <span>5</span></span></h3>
                    </div>
                    <div class="image_container">
                        <img src="images/image5.png" alt="">
                    </div>
                    <div class="question">
                        <h1>Which one you choose ?</h1>
                    </div>
                    <div class="question_option">
                        <button class="option" value="1">Option A</button>
                        <button class="option" value="2">Option B</button>
                        <button class="option" value="3">Option C</button>
                        <button class="option" value="4">Option D</button>
                    </div>
                </div>
                <button class="question_submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
