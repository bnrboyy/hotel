@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/rooms.css">
@endsection

@section('content')
    <div class="my-5 px-4">
        <h1 class="fw-bold text-center">ห้องพักทั้งหมด</h1>
        <div class="h-line bg-dark" style="width: 180px"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">ตัวกรอง</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                                <label class="form-label" style="font-weight: 500;">Check-in</label>
                                <input type="date" class="form-control shadow-none pointer mb-3">
                                <label class="form-label" style="font-weight: 500;">Check-in</label>
                                <input type="date" class="form-control shadow-none pointer">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none pointer mb-3">
                                    <label class="form-check-label" for="f1" style="font-weight: 500;">Facility
                                        one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none pointer mb-3">
                                    <label class="form-check-label" for="f2" style="font-weight: 500;">Facility
                                        true</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none pointer mb-3">
                                    <label class="form-check-label" for="f3" style="font-weight: 500;">Facility
                                        three</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label" for="">Adults</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="form-label" for="">Children</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">
                {{-- Room items --}}

                @foreach ($rooms as $room)
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                @if (count($room->gallery) === 0)
                                    <div class="swiper swiper-gallery">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" style="max-height: 198px; max-wight: 350px;">
                                                <figure style="height: 198px; wight: 350px;">
                                                    <img src="/images/rooms/no-img.jpg" class="h-100 w-100 rounded">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="swiper swiper-gallery">
                                        <div class="swiper-wrapper">
                                            @foreach ($room->gallery as $slide)
                                                <div class="swiper-slide" style="max-height: 198px; max-wight: 350px;">
                                                    <figure style="height: 198px; wight: 350px;">
                                                        <img src="{{ $slide->image }}" class="h-100 w-100 rounded">
                                                    </figure>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                <h5 class="mb-3">{{ $room->name }}</h5>
                                <div class="features mb-3">
                                    <h5 class="mb-1">คุณสมบัติห้อง</h5>
                                    @foreach ($room->features as $fea)
                                        <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                            {{ $fea->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="facilities mb-3">
                                    <h5 class="mb-1">สิ่งอำนวยความสะดวก</h5>
                                    @foreach ($room->facs as $fac)
                                        <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                            {{ $fac->name }}
                                        </span>
                                    @endforeach
                                </div>
                                {{-- <div class="guests">
                                    <h5 class="mb-1">Guests</h5>
                                    <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                        5 Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-wrap fs-6 text-dark">
                                        4 Children
                                    </span>
                                </div> --}}

                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                <h6 class="mb-4">฿ {{ $room->price }} / วัน</h6>
                                <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">จองห้อง</a>
                                <a href="/roomdetails?id={{ $room->id }}" class="btn btn-sm w-100 btn-outline-dark shadow-none">ดูรายละเอียด</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var swiper = new Swiper(".swiper-gallery", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });
    </script>
@endsection
