@forelse ($categories as $category)
    <tr>
        <td style="width: 20%">
            <div class="table_cell">{{ $category->name ?: 'N/A' }}</div>
        </td>
        <td style="width: 35%">
            <div class="table_cell">
                {{ $category->short_desc ?: 'N/A' }}
            </div>
        </td style="width: 35%">
        <td>
            <div class="table_cell">
                {{ $category->long_desc ?: 'N/A' }}
            </div>
        </td>
        <td class="action" style="width: 10%">
            <div class="action-buttons">
                <div class="delete-btn"  data-id="{{ $category->id }}">
                    <i class="bx bx-trash"></i>
                </div>
                <a href="{{ route('admin.category.edit', $category) }}" class="category-edit"
                    data-url="{{ route('admin.category.edit', $category) }}">
                    <i class="bx bx-edit"></i>
                </a>
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

<tr>
    <td colspan="4">
        <div class="pagination-wrapper">
            @include('admin.layout.pagination')
        </div>
    </td>
</tr>
