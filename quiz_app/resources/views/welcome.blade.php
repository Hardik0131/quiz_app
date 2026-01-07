<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nothing</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/quiz.css', 'resources/js/quiz.js'])
    @vite(['resources/css/option.css'])

</head>

<body>
    <div class="main_container">
        <form action="{{ route('quiz.submit') }}" method="POST" id="form">
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
                    <ul class="question_option">
                        <li class="option">
                            <input type="radio" value="1" id="q1_a" name="answer[1]">
                            <label for="q1_a">Option A</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="2" id="q1_b" name="answer[1]">
                            <label for="q1_b">Option B</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="3" id="q1_c" name="answer[1]">
                            <label for="q1_c">Option C</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="4" id="q1_d" name="answer[1]">
                            <label for="q1_d">Option D</label>
                        </li>
                    </ul>
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
                    <ul class="question_option">
                        <li class="option">
                            <input type="radio" value="1" id="q2_a" name="answer[2]">
                            <label for="q2_a">Option A</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="2" id="q2_b" name="answer[2]">
                            <label for="q2_b">Option B</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="3" id="q2_c" name="answer[2]">
                            <label for="q2_c">Option C</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="4" id="q2_d" name="answer[2]">
                            <label for="q2_d">Option D</label>
                        </li>
                    </ul>
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
                    <ul class="question_option">
                        <li class="option">
                            <input type="radio" value="1" id="q3_a" name="answer[3]">
                            <label for="q3_a">Option A</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="2" id="q3_b" name="answer[3]">
                            <label for="q3_b">Option B</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="3" id="q3_c" name="answer[3]">
                            <label for="q3_c">Option C</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="4" id="q3_d" name="answer[3]">
                            <label for="q3_d">Option D</label>
                        </li>
                    </ul>
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
                    <ul class="question_option">
                        <li class="option">
                            <input type="radio" value="1" id="q4_a" name="answer[4]">
                            <label for="q4_a">Option A</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="2" id="q4_b" name="answer[4]">
                            <label for="q4_b">Option B</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="3" id="q4_c" name="answer[4]">
                            <label for="q4_c">Option C</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="4" id="q4_d" name="answer[4]">
                            <label for="q4_d">Option D</label>
                        </li>
                    </ul>
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
                    {{-- <div class="question_option">
                        <button class="option">Option A</button>
                        <button class="option">Option  value="1"B</button>
                        <button class="option">Option  value="2"C</button>
                        <button class="option">Option  value="3"D</button>
                    </div> --}}
                    <ul class="question_option">
                        <li class="option">
                            <input type="radio" value="1" id="q5_a" name="answer[5]">
                            <label for="q5_a">Option A</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="2" id="q5_b" name="answer[5]">
                            <label for="q5_b">Option B</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="3" id="q5_c" name="answer[5]">
                            <label for="q5_c">Option C</label>
                        </li>
                        <li class="option">
                            <input type="radio" value="4" id="q5_d" name="answer[5]">
                            <label for="q5_d">Option D</label>
                        </li>
                    </ul>
                </div>
                <button class="question_submit" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
