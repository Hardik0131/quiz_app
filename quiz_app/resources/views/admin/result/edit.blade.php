<div class="result-admin-nav">
    <div class="result_form">
        <div class="result_text">
            <h1>Create a result</h1>
        </div>

        <div class="result_alert">
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
        <form action="{{ route('admin.result.update', $result) }}" method="POST" class="form" id="form"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="select_post_category">
                <label for="select_category">Select Category</label>
                <div class="select-wrapper">
                    <select name="category_id" id="category_id" data-post-url="{{ route('admin.getPostByCategory') }}">
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $result->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="select_post_category">
                <label for="select_post">Select Post</label>
                <div class="select-wrapper">
                    <select name="post_id" id="post_id">
                        @forelse ($posts as $post)
                            <option value="{{ $post->id }}" {{ old('post_id', $result->post_id) == $post->id ? 'selected' : '' }}>{{ $post->post_name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="select_level">
                <label for="level">Result Level</label>
                <div class="select-wrapper">
                    <select name="level" id="level">
                        <option value="" id="default" disabled selected hidden>-- Select Level --</option>
                        <option value="low" {{ old('level', $result->level) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('level', $result->level) == 'medium' ? 'selected' : ''}}>Medium</option>
                        <option value="hard" {{ old('level', $result->level ) == 'hard' ? 'selected' : ''}}>Hard</option>
                    </select>
                </div>
            </div>
            <div class="form_control">
                <label for="title">Result</label>
                <input type="text" name="title" id="title" placeholder="Enter your Post Title" value="{{ $result->title }}">
            </div>
            <div class="form_control">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form_control">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here...">{{ $result->desc }}</textarea>
            </div>
            <div class="submit_btn">
                <button type="submit">Add result</button>
                <a href="{{ route('admin.result.display') }}" data-url={{ route('admin.result.display') }}
                    class="back_to_result">Back to result Page?</a>
            </div>
        </form>
    </div>
</div>