@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/contactus.css">
@endsection

@section('content')
    <div class="head-title">
        <div class="my-5 px-4">
            <h1 class="fw-bold text-center">CONTACT US</h1>
            <div class="h-line bg-dark"></div>
            <p class="text-center mt-3">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Odit provident ea facere maxime illum harum reprehenderit impedit est tempore accusamus!
                Lorem ipsum dolor, <br> sit amet consectetur adipisicing elit. Recusandae neque iure voluptas,
                possimus magni placeat necessitatibus exercitationem quisquam quis libero.
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <iframe class="w-100 rounded mb-4"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d122451.89499741119!2d102.73769219021564!3d16.44402740987555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122602b91988e2f%3A0x93f0805cf799cc6!2z4LmA4LiX4Lio4Lia4Liy4Lil4LiZ4LiE4Lij4LiC4Lit4LiZ4LmB4LiB4LmI4LiZIOC4reC4s-C5gOC4oOC4reC5gOC4oeC4t-C4reC4h-C4guC4reC4meC5geC4geC5iOC4mSDguILguK3guJnguYHguIHguYjguJkgNDAwMDA!5e0!3m2!1sth!2sth!4v1694336569879!5m2!1sth!2sth"
                        height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="https://maps.app.goo.gl/WvEWra4Ks47Wv2bu9" target="_blank"
                        class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> XXX/120 KHON KAEN
                    </a>
                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel: +669900099" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-1"></i>+669900099
                    </a>
                    <br>
                    <a href="tel: +669900099" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill me-1"></i>+669900099
                    </a>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: nantachai.ru@gmail.com" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i> nantachai.ru@gmail.com
                    </a>
                    <h5 class="mt-4">Follow Us</h5>
                    <a href="" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-line me-1"></i>
                    </a>
                    <a href="" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="" class="d-inline-block text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form>
                        <h5>ส่งข้อความ</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">ชื่อ</label>
                            <input type="text" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">อีเมล</label>
                            <input type="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">หัวข้อเรื่อง</label>
                            <input type="text" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">ข้อความ</label>
                            <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button class="btn text-white shadow-none custom-bg mt-3" type="submit">ส่งข้อความ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
