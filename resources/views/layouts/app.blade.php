<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 5 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- blade name css -->
    @php
        $currentView = \Request::route()->getName();
        $cssFile = public_path('css/' . $currentView . '.css');
    @endphp
    <link href="{{ file_exists($cssFile) ? asset('css/' . $currentView . '.css') : '' }}" rel="stylesheet">
    <link href='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/lib/moment.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src='https://fullcalendar.io/releases/fullcalendar/3.10.2/locale/ko.js'></script>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- 브랜드 또는 로고 -->
                <a class="navbar-brand" href="/">{{ config('app.name', 'My Website') }}</a>
                <!-- 메뉴 아이콘 (모바일용) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- 메뉴 항목들 (왼쪽 정렬) -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('vacation*') ? 'active' : '' }}" href="{{ url('/vacation') }}">휴가 관리</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">사원 정보</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">공지사항</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('office*') ? 'active' : '' }}" href="{{ route('office.index') }}">업무 자료</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="{{ route('posts.index') }}">게시판</a>
                        </li>
                    </ul>
                    <!-- 로그인/로그아웃과 알림, 검색 (오른쪽 정렬) -->
                    <ul class="navbar-nav ms-auto">
                        <!-- 관리 -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">관리</a>
                        </li>
                        <!-- 알림 아이콘 -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bell"></i> <!-- 부트스트랩 아이콘 사용 -->
                            </a>
                        </li>
                        <!-- 로그인/로그아웃 -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('login') }}">로그인</a>
                        </li>
                        <!-- 검색 -->
                        <li class="nav-item">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="검색" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">검색</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="bd-main">
        <div class="container">
            <!-- 여기서 다른 페이지 내용이 들어갑니다. -->
            @yield('content')
        </div>
    </div>

    <footer class=" py-3 mt-4">
        <div class="container-fluid text-end">
            <p>문의 : 강이랑</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- 여기에 다른 JavaScript 파일들을 추가할 수 있습니다. -->
</body>
</html>