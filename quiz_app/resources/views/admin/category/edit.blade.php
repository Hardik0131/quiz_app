<div class="category-admin-nav">
    <div class="category_form">
        <div class="update_category_text">
            <h2>Update Category</h2>
        </div>
        <div class="category_alert">
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
        <form action="{{ route('admin.category.update', $category) }}" method="POST" id="form">
            @csrf
            @method('PUT')
            <div class="form_control">
                <label for="name">Category Name</label>
                <input type="text" class="formControl" id="name" placeholder="Enter Category Name"
                    name="name" autocomplete="off" value="{{ $category->name }}" required>
            </div>
            <div class="form_control">
                <label for="short_desc">Short Description</label>
                <input type="text" class="formControl" id="short_desc" placeholder="Short Description Here.."
                    name="short_desc" autocomplete="off" value="{{ $category->short_desc }}" >
            </div>
            <div class="form_control">
                <label for="long_desc">Long Description</label>
                <textarea name="long_desc" id="long_desc" cols="10" rows="5" placeholder="Long Description Here...">{{ $category->long_desc }}</textarea>
            </div>
            <div class="category_update">
                <button type="submit">Update</button>
                <a href="{{ route('admin.category.display') }}" data-url="{{ route('admin.category.display') }}"
                    class="back_to_category">Back to Home?</a>
            </div>
        </form>
    </div>
</div>
