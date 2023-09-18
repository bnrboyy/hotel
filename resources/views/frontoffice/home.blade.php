@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/home.css">
@endsection

@section('content')
    <!-- Carousel -->
    <div class="fluid">
        <!-- Swiper -->
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="/images/carousel/1.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="/images/carousel/2.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="/images/carousel/3.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="/images/carousel/4.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="/images/carousel/5.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="/images/carousel/6.png" class="w-100 d-block" />
                </div>
            </div>
        </div>
    </div>

    <!-- Check availability form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <div class="d-flex align-items-center">
                    <i class="bi bi-building-fill-check fs-3 me-2"></i>
                    <h5 class="">ตรวจสอบห้องว่าง</h5>
                </div>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none pointer" required>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none pointer" required>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none pointer">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none pointer">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mt-3">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- UR ROOMS -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">ห้องพัก</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4>Room 1</h4>
                        <h5 class="mb-4">฿ 450 / วัน</h5>
                        <div class="features mb-4">
                            <h5 class="mb-1">Features</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h5 class="mb-1">Facilities</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                โทรทัศน์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                แอร์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                ตู้เย็น
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">จองห้อง</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4>Room 1</h4>
                        <h5 class="mb-4">฿ 450 / วัน</h5>
                        <div class="features mb-4">
                            <h5 class="mb-1">Features</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h5 class="mb-1">Facilities</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                โทรทัศน์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                แอร์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                ตู้เย็น
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">จองห้อง</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4>Room 1</h4>
                        <h5 class="mb-4">฿ 450 / วัน</h5>
                        <div class="features mb-4">
                            <h5 class="mb-1">Features</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                1 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h5 class="mb-1">Facilities</h5>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                โทรทัศน์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                แอร์
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                ตู้เย็น
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">จองห้อง</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 text-center mt-5">
                <a href="{{ route('rooms') }}" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">ดูห้องเพิ่มเติม >>></a>
            </div>
        </div>
    </div>

    <!-- FACILITIES -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">OUR FACILITIES</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/1.svg" width="80px">
                <h4 class="mt-3">Wifi</h4>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/2.svg" width="80px">
                <h4 class="mt-3">Wifi</h4>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/3.svg" width="80px">
                <h4 class="mt-3">Wifi</h4>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/4.svg" width="80px">
                <h4 class="mt-3">Wifi</h4>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/facilities/5.svg" width="80px">
                <h4 class="mt-3">Wifi</h4>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="{{ route('facilities') }}" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">ดูเพิ่มเติม >>></a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">TESTTIMONIALS</h2>

    <div class="container">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-ltems-center mb-3 align-items-center mb-3">
                        <i class="bi bi-star-fill fs-3"></i>
                        <h5 class="m-0 ms-2">Random User1</h5>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Rem aut temporibus quisquam autem mollitia reiciendis esse iste,
                        earum nisi velit?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-ltems-center mb-3 align-items-center mb-3">
                        <i class="bi bi-star-fill fs-3"></i>
                        <h5 class="m-0 ms-2">Random User2</h5>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Rem aut temporibus quisquam autem mollitia reiciendis esse iste,
                        earum nisi velit?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-ltems-center mb-3 align-items-center mb-3">
                        <i class="bi bi-star-fill fs-3"></i>
                        <h5 class="m-0 ms-2">Random User3</h5>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Rem aut temporibus quisquam autem mollitia reiciendis esse iste,
                        earum nisi velit?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-ltems-center mb-3 align-items-center mb-3">
                        <i class="bi bi-star-fill fs-3"></i>
                        <h5 class="m-0 ms-2">Random User1</h5>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Rem aut temporibus quisquam autem mollitia reiciendis esse iste,
                        earum nisi velit?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-ltems-center mb-3 align-items-center mb-3">
                        <i class="bi bi-star-fill fs-3"></i>
                        <h5 class="m-0 ms-2">Random User1</h5>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Rem aut temporibus quisquam autem mollitia reiciendis esse iste,
                        earum nisi velit?
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-half text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- REACH US -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">REACH US</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122451.89499741119!2d102.73769219021564!3d16.44402740987555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122602b91988e2f%3A0x93f0805cf799cc6!2z4LmA4LiX4Lio4Lia4Liy4Lil4LiZ4LiE4Lij4LiC4Lit4LiZ4LmB4LiB4LmI4LiZIOC4reC4s-C5gOC4oOC4reC5gOC4oeC4t-C4reC4h-C4guC4reC4meC5geC4geC5iOC4mSDguILguK3guJnguYHguIHguYjguJkgNDAwMDA!5e0!3m2!1sth!2sth!4v1694336569879!5m2!1sth!2sth"
                    height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h4>Call Us</h4>
                    <a href="tel: +669900099" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-1"></i>+669900099
                    </a>
                    <br>
                    <a href="tel: +669900099" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-1"></i>+669900099
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h4>Follow Us</h4>
                    <a href="" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-line me-1"></i>
                            Line
                        </span>
                    </a>
                    <br>
                    <a href="" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i>
                            Facebook
                        </span>
                    </a>
                    <br>
                    <a href="" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i>
                            Instagram
                        </span>
                    </a>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: 3,
            loop:true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
@endsection
