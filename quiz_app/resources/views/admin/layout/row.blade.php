@forelse ($categories as $category)
    <tr>
        <td>
            <div class="table_cell">{{ $category->name ?: 'N/A' }}</div>
        </td>
        <td>
            <div class="table_cell">
                {{ $category->short_desc ?: 'N/A' }}
            </div>
        </td>
        <td>
            <div class="table_cell">
                {{ $category->long_desc ?: 'N/A' }}
            </div>
        </td>
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
