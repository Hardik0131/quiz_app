@extends('layout/master')

@section('content')
    <div class="admin-sub-nav categorie">
        <div class="categories sub-nav">
            <div class="text">Category</div>
            <div class="categories_link">
                <i class="bx bxs-info-circle"></i>
                <a href="#">/ Category</a>
            </div>
        </div>
        <div class="category-content">
            <div class="categories search-bar">
                <div class="categories search-box">
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
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->name ?: 'N/A' }}</td>
                            <td>{{ $category->short_desc ?: 'N/A' }}</td>
                            <td>{{ $category->long_desc ?: 'N/A' }}</td>
                            <td class="action">
                                <div class="action-buttons">
                                    <div class="delete-btn">
                                        <i class="bx bx-trash"></i>
                                    </div>
                                    <div class="edit-btn">
                                        <i class="bx bx-edit"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding:20px;">
                                No Category Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
