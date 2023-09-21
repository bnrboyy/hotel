@extends('backoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/backoffice/feature-fac.css">
@endsection

@section('content')
    <h3><i class="bi bi-ui-checks"></i> Features & Facilities</h3>

    <div class="d-flex flex-column gap-3">
        <!-- Message section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-4">
                        #Features ( คุณสมบัติห้องพัก )
                    </h5>
                    <button type="button" class="btn btn-dark shadow-none btn-md" data-bs-toggle="modal"
                        data-bs-target="#carousel-s">
                        <i class="bi bi-plus-square"> </i> เพิ่ม Feature
                    </button>
                </div>
                <table id="features" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>การแสดงผล</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>feature 1</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input onchange="upd_fac_display(this.checked)" isChecked="false" class="form-check-input shadow-none" type="checkbox" id="feature-toggle">
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger shadow-none" onclick="deleteFeature(this)"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 mb-4">
                            #Facilities ( สิ่งอำนวยความสะดวก )
                        </h5>
                        <button type="button" class="btn btn-dark shadow-none btn-md" data-bs-toggle="modal"
                            data-bs-target="#carousel-s">
                            <i class="bi bi-plus-square"> </i> เพิ่ม Facility
                        </button>
                    </div>
                    <table id="facilities" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>icon</th>
                                <th>ชื่อ</th>
                                <th>คำอธิบาย</th>
                                <th>การแสดงผล</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities as $fac)
                                <tr>
                                    <td>{{ $fac->id }}</td>
                                    <td>{{ $fac->icon }}</td>
                                    <td>{{ $fac->name }}</td>
                                    <td>{{ $fac->description }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input onchange="upd_feature_display(this.checked)" isChecked="false" class="form-check-input shadow-none" type="checkbox" id="feature-toggle">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger shadow-none" onclick="deleteFac(this)"><i class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






    <!-- Show message Modal -->
    <div class="modal fade" id="message-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">รายละเอียดข้อความ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">ชื่อ</label>
                            <input name="name" type="text" class="form-control form-msg shadow-none" readonly>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">อีเมล</label>
                                    <input name="email" type="email" class="form-control form-msg shadow-none" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mt-3">
                                    <label class="form-label" style="font-weight: 500;">เบอร์โทร</label>
                                    <input name="phone" type="number" class="form-control form-msg shadow-none"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        onKeyPress="if(this.value.length>=10) return false;" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">หัวข้อเรื่อง</label>
                            <input name="subject" type="text" class="form-control form-msg shadow-none" readonly>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">ข้อความ</label>
                            <textarea name="message" class="form-control form-msg shadow-none" rows="5" style="resize: none;" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/backoffice/feature-fac.js"></script>

    <script>
        function upd_fac_display(_checked) {
            console.log(_checked)
        }

        function upd_feature_display(_checked) {
            console.log(_checked)
        }

        function deleteFeature(_el) {
            console.log(_el)
        }

        function deleteFac(_el) {
            console.log(_el)
        }

    </script>
@endsection
