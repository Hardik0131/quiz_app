<div class="category-admin-nav">
    <div class="admin-sub-nav category">
        <div class="category sub-nav">
            <div class="text">Category</div>
            <div class="category_link">
                <i class="bx bxs-info-circle"></i>
                <a href="#">/ Category</a>
            </div>
        </div>
        <div class="category-content">
            <div class="category search-bar">
                <div class="category search-box">
                    <input type="search" placeholder="Search here... " id="searchInput" class="category-search">
                    <i class="bx bx-search"></i>
                </div>
                <div class="add-new-category newcategory">
                    <button>
                        <i class="bx bx-plus"></i>
                        <div class="add-category-text">
                            Add Category
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div id="categoryTable">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Category Name</th>
                        <th scope="col">Short Desc</th>
                        <th scope="col">Long Desc</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="categoryBody">
                    @include('admin.layout.row')
                    <tr>
                        <td colspan="4">
                            <div class="pagination-wrapper">
                                @include('admin.layout.pagination')
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
