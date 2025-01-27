<nav class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading sr-only">업무 자료</div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('office.index') ? 'active' : '' }}" href="{{ route('office.index') }}">회사 생활</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('office.link.index') ? 'active' : '' }}" href="{{ route('office.link.index') }}">업무 링크</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('office.account.index') ? 'active' : '' }}" href="{{ route('office.account.index') }}">공용 계정</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('office.partner.index') ? 'active' : '' }}" href="{{ route('office.partner.index') }}">파트너 정보</a>
        </li>
    </ul>
</nav>