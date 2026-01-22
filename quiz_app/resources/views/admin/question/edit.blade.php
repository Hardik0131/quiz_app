<div class="question-admin-nav">
    <div class="question_form">
        <div class="update_question_text">
            <h2>Update Question</h2>
        </div>
        <div class="question_alert">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error message">
                        <h2><strong>Error !</strong>{{ $error }}</h2>
                        <i class="bx bx-x"></i>
                    </div>
                @endforeach
            @elseif(session('success'))
                <div class="success">
                    <h2><strong>Success !</strong>{{ session('success') }}</h2>
                    <i class="bx bx-x"></i>
                </div>
            @endif
        </div>
        <form action="{{ route('admin.question.update', $question) }}" method="POST" id="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="select_post_category">
                <label for="select_category">Select Category</label>
                <div class="select-wrapper">
                    <select name="category_id" id="category_id" data-post-url="{{ route('admin.getPostByCategory') }}">
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $question->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="select_post_category">
                <label for="select_post">Select Post <small style="color: red">( If You want to change the Post first change the category )</small></label>
                <div class="select-wrapper">
                    <select name="post_id" id="post_id">
                        @forelse ($posts as $post)
                            <option value="{{ $post->id }}"
                                {{ old('post_id', $question->post_id) == $post->id ? 'selected' : '' }}>
                                {{ $post->post_name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form_control">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" placeholder="Enter your Post Title"
                    value="{{ $question->question }}">
            </div>
            <div class="form_control">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form_control">
                <label for="option_a">Option A</label>
                <input type="text" name="option_a" id="option_a" placeholder="Enter Option A"
                    value="{{ $question->option_a }}">
            </div>
            <div class="form_control">
                <label for="option_b">Option B</label>
                <input type="text" name="option_b" id="option_b" placeholder="Enter Option B"
                    value="{{ $question->option_b }}">
            </div>
            <div class="form_control">
                <label for="option_c">Option C</label>
                <input type="text" name="option_c" id="option_c" placeholder="Enter Option C"
                    value="{{ $question->option_c }}">
            </div>
            <div class="form_control">
                <label for="option_d">Option D</label>
                <input type="text" name="option_d" id="option_d" placeholder="Enter Option D"
                    value="{{ $question->option_d }}">
            </div>
            <div class="form_control">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here...">{{ $question->desc }}</textarea>
            </div>
            <div class="submit_btn">
                <button type="submit">Add Question</button>
                <a href="{{ route('admin.question.display') }}" data-url={{ route('admin.question.display') }}
                    class="back_to_question">Back to Question Page?</a>
            </div>
        </form>
    </div>
</div>
