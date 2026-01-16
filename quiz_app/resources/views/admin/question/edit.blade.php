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
                        <i class="ri-close-line"></i>
                    </div>
                @endforeach
            @elseif(session('success'))
                <div class="success">
                    <h2><strong>Success !</strong>{{ session('success') }}</h2>
                    <i class="ri-close-line"></i>
                </div>
            @endif
        </div>
        <form action="{{ route('admin.question.update', $question) }}" method="POST" id="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form_control">
                <label for="question">Question</label>
                <input type="text" name="question" id="question" placeholder="Enter your Post Title" value="{{ $question->question }}">
            </div>
            <div class="form_control">
                <div class="select-wrapper">
                    <select name="post_id" id="select_post" required>
                        @forelse ($posts as $post)
                            <option value="{{ $post->id }}" {{ old('post_id' == $post->id ? 'selected' : '')}}>{{ $post->post_name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form_control">
                <input type="file" name="image" id="image">
            </div>
            <div class="form_control">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here...">{{ $question->desc }}</textarea>
            </div>
            <div class="submit_btn">
                <button type="submit">Add Question</button>
                <a href="{{ route('admin.question.display') }}">Back to Question Page?</a>
            </div>
        </form>
    </div>
</div>
