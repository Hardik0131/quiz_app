<div class="question-admin-nav">
    <div class="admin-sub-nav question">
        <div class="question sub-nav">
            <div class="text">Question</div>
            <div class="question_link">
                <i class="bx bxs-info-circle"></i>
                <a href="#">/ Question</a>
            </div>
        </div>
        <div class="question-content">
            <div class="question search-bar">
                <div class="question search-box">
                    <input type="search" placeholder="Search here... " id="searchInput" class="question-search"
                        autocomplete="off">
                    <i class="bx bx-search"></i>
                </div>
                <div class="add-question newquestion">
                    <a href="{{ route('admin.question.addQuestion') }}"
                        data-url="{{ route('admin.question.addQuestion') }}" class="add-question">
                        <button>
                            <i class="bx bx-plus"></i>
                            <div class="add-question-text">
                                Add Question
                            </div>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        {{-- <div class="filter-bar">
            <select name="category_id" id="category_id" name="category_id">
                <option value="" selected hidden disabled>-- Select Category --</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                    <option value="">Category Not Found</option>
                @endforelse
            </select>
            <select name="category_id" id="category_id" name="category_id">
                <option value="" selected hidden disabled>-- Select Category --</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                    <option value="">Category Not Found</option>
                @endforelse
            </select>
        </div> --}}
        <div class="question-delete-alert">

        </div>
        <div id="questionTable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Question</th>
                        <th scope="col">Category</th>
                        <th scope="col">Post</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="questionBody">
                    @include('admin.layout.row')
                </tbody>
            </table>
        </div>
    </div>
</div>
