<div class="question-admin-nav">
    <div class="question_form">
        <div class="question_text">
            <h1>Create a Question</h1>
        </div>

        <div class="question_alert">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">
                        <div class="alert-warning-message">
                            <strong>Error!</strong>
                            {{ $error }}
                        </div>
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                @endforeach
            @elseif(session('success'))
                <div class="alert alert-success" role="alert">
                    <div class="alert-success-message">
                        <strong>Success!</strong>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
            @endif
        </div>
        <form action="{{ route('admin.question.store') }}" method="POST" class="form" id="form"
            enctype="multipart/form-data">
            @csrf
            <div class="select_post_category">
                <label for="select_category">Select Category</label>
                <div class="select-wrapper">
                    <select name="category_id" id="category_id" data-post-url="{{ route('admin.getPostByCategory') }}" data-question-url="{{ route('admin.getQuestionByCategory')}}">
                        <option value="" id="default" disabled selected hidden>-- Select Category --</option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="select_post_category">
                <label for="select_post">Select Post</label>
                <div class="select-wrapper">
                    <select name="post_id" id="post_id" data-question-url="{{ route('admin.getQuestionByCategory')}}">
                        <option value="" id="default" disabled selected hidden>-- Select Post --
                        </option>
                        @forelse ($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->post_name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form_control">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" placeholder="Enter your Post Title">
            </div>
            <div class="form_control">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form_control">
                <label for="option_a">Option A</label>
                <input type="text" name="option_a" id="option_a" placeholder="Enter Option A">
            </div>
            <div class="form_control">
                <label for="option_b">Option B</label>
                <input type="text" name="option_b" id="option_b" placeholder="Enter Option B">
            </div>
            <div class="form_control">
                <label for="option_c">Option C</label>
                <input type="text" name="option_c" id="option_c" placeholder="Enter Option C">
            </div>
            <div class="form_control">
                <label for="option_d">Option D</label>
                <input type="text" name="option_d" id="option_d" placeholder="Enter Option D">
            </div>
            <div class="form_control">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here..."></textarea>
            </div>
            <div class="submit_btn">
                <button type="submit">Add Question</button>
                <a href="{{ route('admin.question.display') }}" data-url={{ route('admin.question.display') }}
                    class="back_to_question">Back to Question Page?</a>
            </div>
        </form>
    </div>
</div>
