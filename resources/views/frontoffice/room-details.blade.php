@extends('frontoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/rooms.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 my-3 px-4">
                <h2 class="fw-bold">ห้อง : {{ $room->name }}</h2>
                <div style="font-size: 14px;">
                    <a href="{{ route('home') }}" class="text-secondary text-decoration-none">หน้าหลัก</a>
                    <span class="text-secondary"> > </span>
                    <a href="{{ route('rooms') }}" class="text-secondary text-decoration-none">ห้องพัก</a>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide">
                    <div class="carousel-indicators">
                      @foreach ($room->gallery as $key => $slide)
                          <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="{{ $key }}" class="{{ $slide->default === 1 ? 'active' : "" }} bg-dark" aria-current="{{ $slide->default === 1 ? 'true' : "" }}"></button>
                      @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($room->gallery as $slide)
                            <div class="carousel-item {{ $slide->default === 1 ? 'active' : "" }}">
                                <img src="{{ $slide->image }}" class="d-block w-100 h-100 rounded">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="mb-4">฿ {{ $room->price }} / วัน</h5>
                        <div class="features mb-2">
                            <h5 class="mb-1">คุณสมบัติห้อง</h5>
                            @foreach ($room->features as $fea)
                                <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                    {{ $fea->name }}
                                </span>
                            @endforeach
                        </div>
                        <div class="features mb-2">
                            <h5 class="mb-1">จำนวนผู้เข้าพัก</h5>
                            <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                ผู้ใหญ่ : {{ $room->adult }}
                            </span>
                            <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                เด็ก : {{ $room->children }}
                            </span>
                        </div>
                        <div class="facilities mb-4">
                            <h5 class="mb-1">สิ่งอำนวยความสะดวก</h5>
                            <div class="row">
                                @foreach ($room->facs as $fac)
                                    <div class="col-4 d-flex flex-column align-items-center gap-2 mb-2">
                                        <img src="{{ $fac->icon }}" width=30>
                                        <span class="badge rounded-pill bg-light text-wrap text-dark" style="font-size: 14px; font-weight: 400;">
                                            {{ $fac->name }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-evenly">
                            <a href="#" class="btn btn-sm text-white custom-bg w-100 fs-4" style="height: 45px;">จองห้อง</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 px-4">
                <div class="mb-4 mt-3">
                    <h5>รายละเอียดห้อง</h5>
                    <p>{{ $room->description }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
