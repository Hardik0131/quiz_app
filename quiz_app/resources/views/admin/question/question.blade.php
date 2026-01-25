<div class="question-admin-nav">
    <div class="admin-sub-nav question">
        <div class="question sub-nav">
            <div class="text">Question</div>
            <div class="add-new-question newquestion">
                <a href="{{ route('admin.question.addQuestion') }}" data-url="{{ route('admin.question.addQuestion') }}"
                    class="add-question">
                    <button>
                        <i class="bx bx-plus"></i>
                        <div class="add-question-text">
                            Add Question
                        </div>
                    </button>
                </a>
            </div>
        </div>
        {{-- <div class="question-content">
            <div class="question search-bar">

            </div>
        </div> --}}
        <div class="filter-bar">
            <div class="category_select">
                <div class="filter-select-wrapper">
                    <select name="category_id" id="select_category"
                        data-post-url="{{ route('admin.getPostByCategory') }}"
                        data-question-url="{{ route('admin.getQuestionByCategory') }}">
                        <option value="" id="default" selected >-- Select Category --
                        </option>
                        @forelse ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="post_select">
                <div class="filter-select-wrapper">
                    <select name="post_id" id="select_post"
                        data-question-url="{{ route('admin.getQuestionByCategory') }}">
                        <option value="" id="default" selected>-- Select Post --
                        </option>
                        @forelse ($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->post_name }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div>
            {{-- <div class="question_select">
                <div class="filter-select-wrapper">
                    <select name="question_id" id="select_question">
                        <option value="" id="default" selected>-- Select Question --
                        </option>
                        @forelse ($questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div> --}}
            <div class="search_input">
                <div class="input_container">
                    <span><i class="bx bx-search"></i></span>
                    <input type="search" placeholder="Search here... " id="searchInput" class="question-search"
                        autocomplete="off" name="search">
                </div>
            </div>
            <div class="btn">
                <button type="button" id="applyFilter">Apply</button>
            </div>
        </div>
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
