@if (request()->routeIs('admin.category.display'))
    {!! $categories->links('vendor.pagination.category-pagination') !!}
@elseif(request()->routeIs('admin.post.display'))
    {!! $posts->links('vendor.pagination.category-pagination') !!}
@elseif(request()->routeIs('admin.question.display'))
    {!! $questions->links('vendor.pagination.category-pagination') !!}
@endif