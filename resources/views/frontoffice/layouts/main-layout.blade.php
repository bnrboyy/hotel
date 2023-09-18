<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/main.css">
    @yield('style')
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <title>Hotel Booking</title>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-2 shadow-sm sticky-top">
        <div class="nav-container container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-2" href="{{ route('home') }}">Hotel Booking</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" data-slug="/" aria-current="page" href="{{ route('home') }}">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" data-slug="/rooms" href="{{ route('rooms') }}">ห้องพัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" data-slug="/facilities" href="{{ route('facilities') }}">สิ่งอำนวยความสะดวก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" data-slug="/contactus" href="{{ route('contactus') }}">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" data-slug="/about" href="{{ route('about') }}">เกี่ยวกับเรา</a>
                    </li>
                </ul>
                <div class="d-flex">
                    {{-- <button class="btn btn-outline-success shadow-none">Search</button> --}}
                    <button type="button" class="btn btn-outline-dark me-lg-2 me-3 shadow-none" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        เข้าสู่ระบบ
                    </button>
                    <button type="button" class="btn btn-outline-dark me-lg-2 me-3 shadow-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                        สมัครสมาชิก
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        <h4 class="modal-title" id="staticBackdropLabel">เข้าสู่ระบบ</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address :</label>
                            <input type="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password :</label>
                            <input type="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none" type="submit">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot
                                Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                        <h4 class="modal-title" id="staticBackdropLabel">สมัครสมาชิก</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base text-dark">
                            Note: Your details must match with your ID (Aadharr card, passport, driving, licence, etc.)
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name :</label>
                                    <input type="text" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email :</label>
                                    <input type="email" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number :</label>
                                    <input type="text" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Picture :</label>
                                    <input type="file" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address :</label>
                                    <textarea class="form-control shadow-none" rows="1"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode :</label>
                                    <input type="number" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of birth :</label>
                                    <input type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">password :</label>
                                    <input type="password" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password :</label>
                                    <input type="password" class="form-control shadow-none" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none">สมัครสมาชิก</button>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Email address :</label>
                            <input type="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password :</label>
                            <input type="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button class="btn btn-dark shadow-none" type="submit">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>


    @yield('content')


    <!-- Footer -->
    <footer class="footer-container bg-white mt-auto">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h1 class="fw-bold fs-2 mb-2">{{ $shareSite->site_title }}</h1>
                <p>
                    {{ $shareSite->site_about }}
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h4 class="mb-3">หน้า</h4>
                <div class="d-flex flex-column">
                    <a href="{{ route('home') }}" class="d-inline-block mb-2 text-dark text-decoration-none">หน้าหลัก</a>
                    <a href="{{ route('rooms') }}" class="d-inline-block mb-2 text-dark text-decoration-none">ห้องพัก</a>
                    <a href="{{ route('facilities') }}" class="d-inline-block mb-2 text-dark text-decoration-none">สิ่งอำนวยความสะดวก</a>
                    <a href="{{ route('contactus') }}" class="d-inline-block mb-2 text-dark text-decoration-none">ติดต่อเรา</a>
                    <a href="{{ route('about') }}" class="d-inline-block mb-2 text-dark text-decoration-none">เกี่ยวกับเรา</a>
                </div>
            </div>
            <div class="col-lg-4 p-4">
                <h4 class="mb-3">ติดตามเรา</h4>
                <a href="{{ $shareContact->line }}" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none mb-2">
                    <i class="bi bi-line me-1"></i> Line
                </a><br>
                <a href="{{ $shareContact->fb }}" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none mb-2">
                    <i class="bi bi-facebook me-1"></i> Facebook
                </a><br>
                <a href="{{ $shareContact->ig }}" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-instagram me-1"></i> Instagram
                </a><br>
            </div>
        </div>
        <h5 class="text-center bg-dark text-white p-3 m-0 fw-normal fs-6">Designed and Developed by bnrboyy</h5>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script src="/js/frontoffice/main-layout.js"></script>

    @yield('scripts')
</body>

</html>
