<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Product</div>
        <i class="bx bx-menu" id="btn"></i>
    </div>

    <ul class="nav-list">
        <li>
            <a href="{{ route('admin.category.display') }}"
                class="{{ request()->routeIs('admin.category*') ? 'active' : '' }} sidebar-link"
                data-url="{{ route('admin.category.display') }}">
                <i class="ri-apps-line"></i>
                <span class="links_name">Category</span>
            </a>
            <span class="tooltip">Category</span>
        </li>
        <li>
            <a href="{{ route('admin.post.display') }}"
                class="{{ request()->routeIs('admin.post*') ? 'active' : '' }} sidebar-link"
                data-url="{{ route('admin.post.display') }}">
                <i class="ri-file-list-line"></i>
                <span class="links_name">Posts</span>
            </a>
            <span class="tooltip">Posts</span>
        </li>
        <li>
            <a href="{{ route('admin.question.display') }}"
                class="{{ request()->routeIs('admin.question*') ? 'active' : '' }} sidebar-link"
                data-url="{{ route('admin.question.display') }}">
                <i class="ri-question-line"></i>
                <span class="links_name">Question</span>
            </a>
            <span class="tooltip">Question</span>
        </li>
        <li>
            <a>
                <i class="ri-bar-chart-line"></i>
                <span class="links_name">Result</span>
            </a>
            <span class="tooltip">Result</span>
        </li>
        {{-- <li>
            <a href="#" class="sidebar-link">
                <i class="ri-question-answer-line"></i>
                <span class="links_name">Answer</span>
            </a>
            <span class="tooltip">Answer</span>
        </li> --}}
    </ul>
</div>
