<div class="post-admin-nav">
    <div class="admin-sub-nav post">
        <div class="post sub-nav">
            <div class="text">Post</div>
            <div class="post_link">
                <i class="bx bxs-info-circle"></i>
                <a href="#">/ Post</a>
            </div>
        </div>
        <div class="post-content">
            <div class="post search-bar">
                <div class="post search-box">
                    <input type="search" placeholder="Search here... " id="searchInput" class="post-search" autocomplete="off">
                    <i class="bx bx-search"></i>
                </div>
                <div class="add-new-post newpost">
                    <a href="{{ route('admin.post.addpost') }}"
                        data-url="{{ route('admin.post.addpost') }}" class="add-post">
                        <button>
                            <i class="bx bx-plus"></i>
                            <div class="add-post-text">
                                Add Post
                            </div>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="post-delete-alert">
            
        </div>
        <div id="postTable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Post Name</th>
                        <th scope="col">Short Desc</th>
                        <th scope="col">Long Desc</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="postBody">
                    @include('admin.layout.row')
                </tbody>
            </table>
        </div>
    </div>
</div>
