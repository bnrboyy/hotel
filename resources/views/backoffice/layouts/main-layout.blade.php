<!DOCTYPE html>
<html lang="en">

<head>
    @include('backoffice.layouts.header')
    @yield('style')
    <link rel="stylesheet" href="css/backoffice/main-admin.css">
    <title>admin</title>
</head>

<body class="bg-light">
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between align-items-center">
                <h1 class="fs-5"><span class="bg-white text-dark rounded shadow px-2 me-2">CL</span><span
                        class="text-white">Hotel Booking</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="bi bi-list"
                        style="font-size: 30px;"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class=""><a href="javascript:getPage('')" class="text-decoration-none px-3 py-2 d-block"><i
                            class="bi bi-house-door" style="font-size: 20px;"></i> แผงควบคุม</a></li>
                <li class="nav-collapse">
                    <a onclick="rotateIcon()"
                        class="toggle-collapse text-decoration-none px-3 py-2 d-flex gap-1 align-items-center"
                        data-bs-toggle="collapse" href="#bookingLinks" role="button" aria-expanded="false"
                        aria-controls="bookingLinks">
                        <i class="bi bi-kanban-fill" style="font-size: 20px;"></i>
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>จัดการการจอง</span>
                            <span class="caret-icon text-end"><i class="bi bi-caret-down-fill"></i></span>
                        </div>
                    </a>
                    <div class="collapse" id="bookingLinks" style="padding-left: 1.5rem;">
                        <ul class="nav flex-column">
                            <li class="managebook">
                                <a class="nav-link text-decoration-none"
                                    href="javascript:getPage('managebook')">รายการจอง</a>
                            </li>
                            <li class="booking">
                                <a class="nav-link text-decoration-none" href="javascript:getPage('booking')">Link</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="rooms"><a href="javascript:getPage('rooms')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-hospital"
                            style="font-size: 20px;"></i> จัดการห้องพัก</a></li>
                <li class="messages"><a href="javascript:getPage('messages')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-chat-right-text"
                            style="font-size: 20px;"></i> ข้อความ</a></li>
                <li class="features_fac"><a href="javascript:getPage('features_fac')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-ui-checks-grid"
                            style="font-size: 20px;"></i> คุณสมบัติ & ความสะดวก</a></li>
                <li class="carousel"><a href="javascript:getPage('carousel')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-images"
                            style="font-size: 20px;"></i> ภาพโฆษณา</a></li>
                <li class="users"><a href="javascript:getPage('users')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-people"
                            style="font-size: 20px;"></i> จัดการผู้ใช้งาน</a></li>
                <li class="settings"><a href="javascript:getPage('settings')"
                        class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-sliders"
                            style="font-size: 20px;"></i> ตั้งค่าระบบ</a></li>
            </ul>
            <hr class="h-color mx-2">
        </div>

        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light nav-bg">
                <div class="container-fluid justify-content-md-end justify-content-between">
                    <div class="d-flex justify-content-between d-md-none d-block align-items-center">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="bi bi-list"
                                style="font-size: 30px;"></i></button>
                        <a href="/admin" class="navbar-brand fs-4"><span
                                class="bg-dark rounded px-2 py-0 text-white">CL</span></a>
                    </div>

                    <div class="profile bg-light">
                        <div>
                            <img src="/images/backoffice/user.png">

                            <div class="frofile-card shadow rounded bg-white">
                                <div class="details d-flex gap-2 align-items-center p-3 w-100 h-75">
                                    <img class="img" src="/images/backoffice/user.png">
                                    <div class="text-center d-flex flex-column justify-content-center">
                                        <p class="display">{{ $shareUser->display_name }}</p>
                                        <span class="email">{{ $shareUser->username }}</span>
                                    </div>
                                </div>
                                <button onclick="onLogout()"
                                    class="action w-100 h-25 bg-dark text-light d-flex gap-2 align-items-center justify-content-center"
                                    style="border: none;">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span class="">ออกจากระบบ</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="dashboard-content container-fluid px-3 pt-4">

                @yield('content')

            </div>
        </div>
    </div>







    @include('backoffice.layouts.scripts')

    <script>
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const paramValue = params.get('page');
        const toggle_collapse = document.querySelector('.toggle-collapse');
        const collapse_show = toggle_collapse.getAttribute('aria-expanded');
        const caret_icon = document.querySelector('.caret-icon');

        function rotateIcon() {
            const collapse_show = toggle_collapse.getAttribute('aria-expanded');

            if(collapse_show === 'true') {
                caret_icon.classList.add('active')
            } else if (collapse_show === 'false') {
                caret_icon.classList.remove('active')
            }
        }

        function collapseShow() {
            const bookingLinks = document.querySelector('#bookingLinks');
            const collapse_links = document.querySelectorAll('.nav-collapse li');
            let isShow = false;

            collapse_links.forEach(link => {
                if(link.classList.contains('active')) {
                    isShow = true;
                }
            })

            if (isShow) {
                bookingLinks.classList.add('show')
                caret_icon.classList.add('active')

            } else {
                bookingLinks.classList.remove('show')
                caret_icon.classList.remove('active')

            }
        }

        function activeMenu() {
            $(".sidebar ul li").on('click', function() {
                $(this).addClass('active');
                $('.sidebar ul li.active').removeClass('active');
            })
        }

        document.querySelectorAll('.sidebar ul li').forEach(function(el, ind) {
            if ((el.className === paramValue) || (!paramValue && el.className === "")) {
                el.classList.add('active')
            } else {
                el.classList.remove('active')
            }
        })

        function getPage(_page) {

            if ((_page === paramValue) || (_page === "" && !paramValue)) return false;

            activeMenu();
            if (_page) {
                window.location.href = `/admin?page=${_page}`
            } else {
                window.location.href = `/admin`
            }
        }

        collapseShow();

    </script>

    @yield('script')

</body>

</html>
