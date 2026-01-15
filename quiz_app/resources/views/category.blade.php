<div class="category_form">
    <div class="category_text">
        <h1>Create a Category</h1>
    </div>

    <div class="category_alert">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning" role="alert">
                    <div class="alert-warning-message">
                        <strong>Error!</strong>
                        {{ $error }}
                    </div>
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
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
                    <i class="ri-close-line"></i>
                </button>
            </div>
        @endif
    </div>
    <form action="{{ route('category.store') }}" method="POST" class="form" id="form">
        @csrf
        <div class="form_control">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your Category Name">
        </div>
        <div class="form_control">
            <label for="short_desc">Short Description</label>
            <input type="text" name="short_desc" id="short_desc" placeholder="Short Description Here...">
        </div>
        <div class="form_control">
            <label for="long_desc">Long Description</label>
            <textarea name="long_desc" id="long_desc" cols="10" rows="5" placeholder="Long Description Here..."></textarea>
        </div>
        <div class="category_submit">
            <button type="submit">Submit</button>
            <a href="{{ route('post.create') }}">Create a Post?</a>
        </div>
    </form>
</div>