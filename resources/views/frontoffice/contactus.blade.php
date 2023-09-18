@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/contactus.css">
@endsection

@section('content')
    <div class="head-title">
        <div class="my-5 px-4">
            <h1 class="fw-bold text-center">CONTACT US</h1>
            <div class="h-line bg-dark"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 ">
                    <iframe class="w-100 rounded mb-4"
                        src="{{ $contact->iframe }}"
                        height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="row">
                        <div class="col-6">
                            <h5>ที่อยู่</h5>
                            <a href="{{ $contact->gmap }}" target="_blank"
                                class="d-inline-block text-decoration-none text-dark mb-2">
                                <i class="bi bi-geo-alt-fill"></i> {{ $contact->address }}
                            </a>
                        </div>
                        <div class="col-6">
                            <h5 class="">เบอร์โทร</h5>
                            <a href="tel: {{ $contact->phone1 }}" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill me-1"></i>{{ $contact->phone1 }}
                            </a>
                            <br>
                            <a href="tel: {{ $contact->phone2 }}" class="d-inline-block mb-2 text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill me-1"></i>{{ $contact->phone2 }}
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="">อีเมล</h5>
                            <a href="mailto: {{ $contact->email }}" class="d-inline-block text-decoration-none text-dark">
                                <i class="bi bi-envelope-fill"></i> {{ $contact->email }}
                            </a>
                        </div>
                        <div class="col-6">
                            <h5 class="">ติดตามเรา</h5>
                            <a href="{{ $contact->line }}" class="d-inline-block text-dark fs-5 me-2" target="_blank">
                                <i class="bi bi-line me-1"></i>
                            </a>
                            <a href="{{ $contact->fb }}" class="d-inline-block text-dark fs-5 me-2" target="_blank">
                                <i class="bi bi-facebook me-1"></i>
                            </a>
                            <a href="{{ $contact->ig ? $contact->ig : "#" }}" class="d-inline-block text-dark fs-5">
                                <i class="bi bi-instagram me-1"></i>
                            </a>
                        </div>
                    </div>
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
