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
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-2 h-font" href="{{ route('home') }}">Hotel Booking</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2 fs-6" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" href="#">ห้องพัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" href="{{ route('facilities') }}">สิ่งอำนวยความสะดวก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 fs-6" href="{{ route('about') }}">เกี่ยวกับเรา</a>
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
                <h1 class="h-font fw-bold fs-2 mb-2">Hotel Booking</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Sunt aspernatur enim magnam tenetur optio adipisci consequuntur non odio,
                    explicabo laboriosam.
                </p>
            </div>
            <div class="col-lg-4 p-4">
                <h4 class="mb-3">Links</h4>
                <div class="d-flex flex-column">
                    <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a>
                    <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a>
                    <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a>
                    <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a>
                    <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
                </div>
            </div>
            <div class="col-lg-4 p-4">
                <h4 class="mb-3">Follow Us</h4>
                <a href="" class="d-inline-block mb-2 text-dark text-decoration-none mb-2">
                    <i class="bi bi-line me-1"></i> Line
                </a><br>
                <a href="" class="d-inline-block mb-2 text-dark text-decoration-none mb-2">
                    <i class="bi bi-facebook me-1"></i> Facebook
                </a><br>
                <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">
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

    @yield('scripts')
</body>

</html>
