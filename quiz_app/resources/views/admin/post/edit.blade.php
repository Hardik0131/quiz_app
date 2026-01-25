<div class="post-admin-nav">
    <div class="post_form">
        <div class="update_post_text">
            <h2>Update Post</h2>
        </div>
        <div class="post_alert">
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
        <form action="{{ route('admin.post.update', $post) }}" method="POST" id="form"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form_control">
                <label for="post_name">Post Title</label>
                <input type="text" name="post_name" id="post_name" placeholder="Enter your Post Title"
                    value="{{ $post->post_name }}">
            </div>
            <div class="form_control">
                <div class="select-wrapper">
                    <select name="category_id" id="select_category">
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id == $category->id ? 'selected' : '') }}>{{ $category->name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="form_control">
                <input type="file" name="image" id="image" value="">
            </div>
            <div class="form_control">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="10" rows="5" placeholder="Description Here...">{{ $post->desc }}</textarea>
            </div>
            <div class="submit_btn">
                <button type="submit">Submit</button>
                <a href="{{ route('admin.post.display') }}" data-url="{{ route('admin.post.display') }}"
                    class="back_to_post">Back to Post?</a>
            </div>
        </form>
    </div>
</div>
