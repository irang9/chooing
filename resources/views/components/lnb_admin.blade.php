<nav class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading sr-only">관리자 메뉴</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">대시보드</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.company_info.index') ? 'active' : '' }}" href="{{ route('admin.company_info.index') }}">회사 정보</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.work_info.index') ? 'active' : '' }}" href="{{ route('admin.work_info.index') }}">근무 조건 세팅</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.vacation_info.index') ? 'active' : '' }}" href="{{ route('admin.vacation_info.index') }}">휴가 정보 세팅</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">사원 등록</a>
        </li>
    </ul>
</nav>