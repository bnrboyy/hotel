@extends('backoffice.layouts.main-layout')

@section('style')
@endsection

@section('content')
    <h3><i class="bi bi-gear-fill"></i> การตั้งค่า</h3>

    <div class="d-flex flex-column gap-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-2">
                        ตั้งค่าทั่วไป
                    </h5>
                    <button onclick="initData()" type="button" class="btn btn-dark shadow-none btn-sm"
                        data-bs-toggle="modal" data-bs-target="#general-s">
                        <i class="bi bi-pencil-square"> </i> แก้ไข
                    </button>
                </div>
                <h6 class="card-subtitle mb-2 fw-bold">ชื่อเว็บไซต์</h6>
                <p class="card-text">{{ $site->site_title }}</p>
                <h6 class="card-subtitle mb-2 fw-bold">เกี่ยวกับเว็บไซต์</h6>
                <p class="card-text">{{ $site->site_about }}</p>
            </div>
            <input type="hidden" id="title" value="{{ $site->site_title }}">
            <input type="hidden" id="about" value="{{ $site->site_about }}">
        </div>

        <!-- shutdown -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-2">
                        ปิดเว็บไซต์
                    </h5>
                    <div class="form-check form-switch">
                        <input onchange="upd_shutdown(this.checked)" isChecked="{{ $site->shutdown }}" class="form-check-input shadow-none" type="checkbox" id="shutdown-toggle">
                    </div>
                </div>
                <p class="card-text">เมื่อปิดการใช้งานเว็บไซต์ จะไม่สามารถใช้งานเว็บไซต์ได้</p>
            </div>
        </div>

        <!-- Contact details section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-2">
                        ตั้งค่าข้อมูลการติดต่อ
                    </h5>
                    <button onclick="initData()" type="button" class="btn btn-dark shadow-none btn-sm"
                        data-bs-toggle="modal" data-bs-target="#contacts-s">
                        <i class="bi bi-pencil-square"> </i> แก้ไข
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-2 fw-bold">ที่อยู่</h6>
                            <p class="card-text" id="address"></p>
                        </div>
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-2 fw-bold">Google Map</h6>
                            <p class="card-text" id="gmap"></p>
                        </div>
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-2 fw-bold">เบอร์โทร</h6>
                            <p class="card-text mb-1">
                                <i class="bi bi-telephone-fill me-1"></i>
                                <span id="tel1"></span>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-telephone-fill me-1"></i>
                                <span id="tel2"></span>
                            </p>
                        </div>
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-2 fw-bold">E-mail</h6>
                            <p class="card-text" id="email"></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <h6 class="card-subtitle mb-2 fw-bold">Social Links</h6>
                            <p class="card-text mb-1">
                                <i class="bi bi-line me-1"></i>
                                <span id="line"></span>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-facebook me-1"></i>
                                <span id="facebook"></span>
                            </p>
                            <p class="card-text">
                                <i class="bi bi-instagram me-1"></i>
                                <span id="ig"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- General settins Modal -->
    <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return onUpdateSite(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ตั้งค่าทั่วไป</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ชื่อเว็บไซต์ :</label>
                            <input type="text" name="site_title" class="form-title form-control shadow-none"
                                value="{{ $site->site_title }}" required>
                            <input id="site_id" type="hidden" name="site_id" class="form-control shadow-none"
                                value="{{ $site->id }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">เกี่ยวกับเว็บไซต์ :</label>
                            <textarea name="site_about" class="form-about form-control shadow-none" rows="6" required>{{ $site->site_about }}</textarea>
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

    <!-- Contact settins Modal -->
    <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return onUpdateSite(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ตั้งค่าทั่วไป</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ชื่อเว็บไซต์ :</label>
                            <input type="text" name="site_title" class="form-title form-control shadow-none"
                                value="{{ $site->site_title }}" required>
                            <input id="site_id" type="hidden" name="site_id" class="form-control shadow-none"
                                value="{{ $site->id }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">เกี่ยวกับเว็บไซต์ :</label>
                            <textarea name="site_about" class="form-about form-control shadow-none" rows="6" required>{{ $site->site_about }}</textarea>
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
    <script>
        const btn_close = document.querySelector('.btn-close-modal')
        const site_title = document.getElementById('title').value
        const site_about = document.getElementById('about').value
        const site_id = document.getElementById('site_id').value

        let form_title = document.querySelector('.form-title')
        let form_about = document.querySelector('.form-about')


        function onUpdateSite(event) {

            event.preventDefault()

            const form = event.target;
            const formData = new FormData(form);

            axios.post('/admin/updatesite', formData).then(({
                data
            }) => {
                if (data.status) {
                    btn_close.click();
                    Swal.fire({
                        icon: 'success',
                        title: "อัพเดทสำเร็จ",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "/admin?page=settings"
                    })
                }
            }).catch(err => {
                btn_close.click();
                Swal.fire({
                    icon: 'error',
                    title: 'Someting went wrong!',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        }

        function initData() {
            form_title.value = site_title
            form_about.value = site_about
        }

        function upd_shutdown(_checked) {
            axios.post('/admin/updateshutdown', { isChecked: _checked, site_id: site_id}).then(({ data }) => {
                toastr.success(data.description);
            })
        }

        const shutdown = document.getElementById('shutdown-toggle')
        if (parseInt(shutdown.getAttribute('isChecked')) === 1) {
            shutdown.checked = true
        } else {
            shutdown.checked = false
        }

    </script>
@endsection
