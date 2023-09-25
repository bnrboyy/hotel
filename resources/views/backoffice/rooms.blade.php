@extends('backoffice.layouts.main-layout')

@section('style')
    <style>
        .dataTables_length,
        .dataTables_filter {
            display: none;
        }
    </style>
@endsection

@section('content')
    <h3><i class="bi bi-hospital-fill"></i> ห้องพัก</h3>

    <div class="d-flex flex-column gap-3">
        <!-- Message section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-4">
                        #ห้องทั้งหมด
                    </h5>
                    <button type="button" class="btn btn-dark shadow-none btn-md" data-bs-toggle="modal"
                        data-bs-target="#room-s">
                        <i class="bi bi-plus-square"> </i> เพิ่มห้อง
                    </button>
                </div>
                <table id="rooms" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>ราคา</th>
                            <th>จำนวนผู้ใหญ่</th>
                            <th>จำนวนเด็ก</th>
                            <th>พื้นที่ห้อง</th>
                            <th>สถานะเปิดใช้งาน</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 100px;">1</td>
                            <td style="width: 200px;">A1</td>
                            <td>500</td>
                            <td style="width: 200px;">2</td>
                            <td style="width: 200px;">2</td>
                            <td>3*6</td>
                            <td style="width: 200px;">1</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <button class="btn-modal btn btn-warning shadow-none" data-bs-toggle="modal"
                                        onclick="getMessage()" data-bs-target="#message-s"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-info shadow-none"><i class="bi bi-images"></i></button>
                                    <button class="btn btn-danger shadow-none" onclick="deleteMessage()"><i
                                            class="bi bi-trash-fill"></i></button>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create room Modal -->
    <div class="modal fade" id="room-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return createRoom(event)">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มห้องพัก</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">ชื่อ</label>
                                    <input name="name" type="text" class="form-control form-room text-center shadow-none" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">ราคา</label>
                                    <input name="price" type="number" class="form-control form-room text-center shadow-none"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        onKeyPress="if(this.value.length>=8) return false;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">จำนวนผู้ใหญ่</label>
                                    <input name="adult" type="number"
                                        class="form-control form-room shadow-none text-center"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        onKeyPress="if(this.value.length>=8) return false;" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">จำนวนเด็ก</label>
                                    <input name="children" type="number"
                                        class="form-control form-room shadow-none text-center"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        onKeyPress="if(this.value.length>=8) return false;" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">คุณสมบัติห้อง</label>
                            <div class="row select-feature">
                                @foreach ($features as $feature)
                                    <div class="col-md-3 mb-2">
                                        <label>
                                            <input class="form-check-input feature-checked shadow-none" type="checkbox" value="{{ $feature->id }}">
                                            {{ $feature->name }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">สิ่งอำนวยความสะดวก</label>
                            <div class="row select-fac">
                                @foreach ($facilities as $fac)
                                    <div class="col-md-3 mb-2">
                                        <label>
                                            <input class="form-check-input fac-checked shadow-none" type="checkbox" value="{{ $fac->id }}">
                                            {{ $fac->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">รายละเอียดห้อง</label>
                            <textarea name="message" class="form-control form-room shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/backoffice/rooms.js"></script>
@endsection
