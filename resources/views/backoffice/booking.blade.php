@extends('backoffice.layouts.main-layout')

@section('style')
@endsection

@section('content')
    <!-- Check availability form -->
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-building-fill-check fs-3 me-2"></i>
        <h3 class="">จองห้องแบบ Walk-in</h3>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-lg-0 mb-4 px-lg-rounded">
            <div class="container-fluid flex-lg-column bg-white shadow py-2 rounded">
                <h4 class="mt-2">ตัวกรอง</h4>
                <form onsubmit="return searchrooms(event)" id="form-search">
                    <div class="border bg-light p-3 rounded mb-3">
                        <label class="form-label" style="font-weight: 500;">เช็คอิน</label>
                        <input type="date" name="checkin" min="{{ date('Y-m-d') }}" id="date-checkin"
                            class="form-control shadow-none pointer mb-3" required>
                        <label class="form-label" style="font-weight: 500;">เช็คเอ้าท์</label>
                        <input type="date" class="form-control shadow-none pointer" name="checkout" id="date-checkout"
                            required>
                    </div>
                    <div class="border bg-light p-3 rounded mb-3">
                        <h5 class="mb-3" style="font-size: 18px;">จำนวนผู้เข้าพัก</h5>
                        <div class="d-flex">
                            <div class="row w-100">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <label class="form-label" style="font-weight: 500;">ผู้ใหญ่/คน</label>
                                    <select class="form-select select shadow-none pointer text-center" id="select-adult"
                                        name="adult" required>
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12">
                                    <label class="form-label" style="font-weight: 500;">เด็ก/คน</label>
                                    <select class="form-select select shadow-none pointer text-center" id="select-children"
                                        name="children" required>
                                        <option value="0">0</option>
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-center align-items-center">
                        <div class="d-none">
                            <button type="submit" class="btn text-white btn-search shadow-none custom-bg">ค้นหา</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 px-4">
            {{-- Rooms --}}
            @foreach ($rooms as $room)
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-lg-4 mb-lg-0 mb-md-0 mb-3">
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
                        <div class="col-lg-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">{{ $room->name }}</h5>
                            <div class="features mb-2">
                                <h5 class="mb-1">คุณสมบัติห้อง</h5>
                                @foreach ($room->features as $fea)
                                    <span class="badge rounded-pill bg-light text-wrap text-dark"
                                        style="font-size: 14px; font-weight: 400;">
                                        {{ $fea->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="features mb-2">
                                <h5 class="mb-1">จำนวนผู้เข้าพัก</h5>
                                <span class="badge rounded-pill bg-light text-wrap text-dark"
                                    style="font-size: 14px; font-weight: 400;">
                                    ผู้ใหญ่ : {{ $room->adult }}
                                </span>
                                <span class="badge rounded-pill bg-light text-wrap text-dark"
                                    style="font-size: 14px; font-weight: 400;">
                                    เด็ก : {{ $room->children }}
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h5 class="mb-1">สิ่งอำนวยความสะดวก</h5>
                                @foreach ($room->facs as $fac)
                                    <span class="badge rounded-pill bg-light text-wrap text-dark"
                                        style="font-size: 14px; font-weight: 400;">
                                        {{ $fac->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-3 mt-lg-0 mt-md-0 mt-4 text-center">
                            <h5 class="mb-2">฿ {{ $room->price }} / วัน</h5>
                            <button onclick="openBookForm({{ $room->id }})"
                                class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2"
                                style="height: 40px; font-size: 18px;">จองห้อง</button>
                            <button data-bs-toggle="modal" data-bs-target="#bookingform-s"
                                class="btn-modal btn-sm btn-form-modal w-100 text-white custom-bg shadow-none mb-2 d-none"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Booking form Modal -->
    <div class="modal fade" id="bookingform-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return confirmBook(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ข้อมูลผู้จอง / รายละเอียด</h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mb-0">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="mt-3">
                                        <label class="form-label" style="font-weight: 500;">*ชื่อ <span
                                                class="text-secondary">(ภาษาไทย)</span></label>
                                        <input name="fname" type="text" class="form-control form-room shadow-none"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mt-3">
                                        <label class="form-label" style="font-weight: 500;">*นามสกุล <span
                                                class="text-secondary">(ภาษาไทย)</span></label>
                                        <input name="lname" type="text" class="form-control form-room shadow-none"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mt-3">
                                        <label class="form-label" style="font-weight: 500;">*เบอร์โทรศัพท์</label>
                                        <input name="phone" type="number" class="form-control form-room shadow-none"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            onKeyPress="if(this.value.length>=10) return false;" minlength="10" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mt-3">
                                        <label class="form-label" style="font-weight: 500;">*อีเมล</label>
                                        <input name="email" type="email" class="form-control form-room shadow-none"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mt-3">
                                        <label class="form-label" style="font-weight: 500;">*เลขอ้างอิงการจอง</label>
                                        <input name="card_id" type="number" class="form-control form-room shadow-none"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            onKeyPress="if(this.value.length>=4) return false;" minlength="4" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mt-3">
                                    <label class="form-label" style="font-weight: 500;">*การชำระเงิน</label>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="radio" name="payment_type" value="cash" id="cash" checked>
                                        <label class="form-check-label" for="cash">
                                          เงินสด
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input shadow-none" type="radio" name="payment_type" value="transfer" id="transfer">
                                        <label class="form-check-label" for="transfer">
                                          โอนจ่าย
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 card mb-4 border-0">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-12 p-3 pb-0">
                                            <h6 class="text-secondary" style="font-size: 14px;">รายละเอียดการจอง</h6>
                                            <h6 class="text-prebook" style="font-size: 14px; font-weight: 300;"></h6>
                                            <h6 class="text-prebook" style="font-size: 14px; font-weight: 300;"></h6>
                                            <h6 class="text-prebook" style="font-size: 14px; font-weight: 300;"></h6>
                                            <h6 class="text-prebook" style="font-size: 14px; font-weight: 300;"></h6>
                                            <h5 class="text-prebook" style="font-weight: 500;"></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button onclick="closeModal()" type="button" class="btn-close-modal btn bg-secondary text-white shadow-none"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-confirm custom-bg d-flex align-items-center justify-content-center text-white shadow-none" style="width: 117px;">
                            <div class="spinner-border loading d-none" role="status" style="width: 20px; height: 20px;"></div>
                            <div class="text-btn-confirm">ยืนยันการจอง</div>
                        </button>
                    </div>
                </div>
                <input class="pre-value" type="hidden" name="room_id">
                <input class="pre-value" type="hidden" name="checkin">
                <input class="pre-value" type="hidden" name="checkout">
                <input class="pre-value" type="hidden" name="days">
                <input class="pre-value" type="hidden" name="price_per_date">
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
    <script src="/js/backoffice/booking.js"></script>
@endsection
