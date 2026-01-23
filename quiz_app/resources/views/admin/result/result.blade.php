<div class="result-admin-nav">
    <div class="admin-sub-nav result">
        <div class="result sub-nav">
            <div class="text">result</div>
            {{-- This is not usable
            <div class="result_link">
                <i class="bx bxs-info-circle"></i>
                <a href="#">/ result</a>
            </div>
            not usable --}}
            <div class="add-new-result newresult">
                <a href="{{ route('admin.result.addResult') }}" data-url="{{ route('admin.result.addResult') }}"
                    class="add-result">
                    <button>
                        <i class="bx bx-plus"></i>
                        <div class="add-result-text">
                            Add result
                        </div>
                    </button>
                </a>
            </div>
        </div>
        {{-- This is not usable
        <div class="result-content">
            <div class="result search-bar">


            </div>
        </div>
        not usable --}}
        <div class="filter-bar">
            <div class="category_select">
                <div class="filter-select-wrapper">
                    <select name="category_id" id="select_category"
                        data-post-url="{{ route('admin.getPostByCategory') }}">
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
                    <select name="post_id" id="select_post">
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
            {{-- <div class="result_select">
                <div class="filter-select-wrapper">
                    <select name="result_id" id="select_result">
                        <option value="" id="default" selected>-- Select result --
                        </option>
                        @forelse ($allresult as $result)
                            <option value="{{ $result->id }}">{{ $result->result }}</option>
                        @empty
                            <option value="" disabled>Not Record Found</option>
                        @endforelse
                    </select>
                </div>
            </div> --}}
            <div class="search_input">
                <div class="input_container">
                    <span><i class="bx bx-search"></i></span>
                    <input type="search" placeholder="Search here... " id="searchInput" class="result-search"
                        autocomplete="off" name="search">
                </div>
            </div>
            <div class="btn">
                <button type="button" id="applyFilter">Apply</button>
            </div>
        </div>
        <div class="result-delete-alert">

        </div>
        <div id="resultTable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Result</th>
                        <th scope="col">Category</th>
                        <th scope="col">Post</th>
                        <th scope="col">Result Level</th>
                        <th scope="col">Image</th>
                        <th scope="col">Desc</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="resultBody">
                    @include('admin.layout.row')
                </tbody>
            </table>
        </div>
    </div>
</div>