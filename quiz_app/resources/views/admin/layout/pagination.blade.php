@if(request()->routeIs('admin.category.display'))
    {!! $categories->links('vendor.pagination.category-pagination') !!}
@else
    {!! $posts->links('vendor.pagination.category-pagination') !!}
@endif