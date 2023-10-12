@extends('backoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/backoffice/bank.css">
@endsection

@section('content')
    <h3><i class="bi bi-person-fill-lock"></i> ผู้ดูแลระบบ</h3>
    <div class="d-flex flex-column gap-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="mt-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 mb-4">
                            #ผู้ดูแลระบบทั้งหมด
                        </h5>
                        <button type="button" class="btn btn-dark shadow-none btn-md" data-bs-toggle="modal"
                            data-bs-target="#admin-s">
                            <i class="bi bi-plus-square"> </i> เพิ่มผู้ดูแลระบบ
                        </button>
                    </div>
                    <table id="admin" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="">#</th>
                                <th>ชื่อ</th>
                                <th>อีเมล</th>
                                <th>สิทธิ์แอดมิน</th>
                                <th>สถานะแอดมิน</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $admin)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $admin->display_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->admin_role }}</td>
                                    <td><span
                                            class="badge rounded-pill text-light bg-{{ $admin->status === 'เปิดใช้งาน' ? 'success' : 'secondary' }}">{{ $admin->status }}</span>
                                    </td>
                                    <td>
                                        <button class="btn-modal btn btn-warning shadow-none" data-bs-toggle="modal"
                                            onclick="getBank({{ $admin->id }})" data-bs-target="#adminedit-s"><i
                                                class="bi bi-pen-fill"></i></button>
                                        <button class="btn btn-danger shadow-none"
                                            onclick="deleteBank(this, {{ $admin->id }})"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Admin Modal -->
    <div class="modal fade" id="admin-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return createAdmin(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มผู้ดูแลระบบ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12 mb-3">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" name="name" id="name"
                                    class="form-title form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">อีเมล</label>
                                <input type="email" name="email" id="email"
                                    class="form-title form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">รหัสผ่าน <span class="password-valid text-secondary">(รหัสผ่านอย่างน้อย 8 ตัว)</span></label>
                                <input type="password" name="password" id="password"
                                    class="form-title form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">ยืนยันรหัสผ่าน <span class="cpassword-valid text-danger d-none"> : รหัสผ่านกับยืนยันรหัสผ่านต้องตรงกัน</span></label>
                                <input type="password" name="c_password" id="c_password"
                                    class="form-title form-control shadow-none" required>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-select shadow-none pointer" id="admin-role" name="admin_role" required>
                                    <option value="">-- เลือกสิทธิ์แอดมิน --</option>
                                    <option value="แอดมินสูงสุด">แอดมินสูงสุด</option>
                                    <option value="แอดมิน">แอดมิน</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <select class="form-select shadow-none pointer" id="admin-status" name="admin_status"
                                    required>
                                    <option value="">-- เลือกสถานะแอดมิน --</option>
                                    <option value="เปิดใช้งาน">เปิดใช้งาน</option>
                                    <option value="ปิดใช้งาน">ปิดใช้งาน</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="closeModal()" class="btn-close-modal btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Admin Modal -->
    <div class="modal fade" id="adminedit-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return updateBank(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">แก้ไขบัญชีธนาคาร</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <label class="form-label mb-2 text-center">ภาพพร้อมเพย์ธนาคาร <br> ( QR code )</label>
                            <div class="col-6">
                                <div class="group-image mb-3">
                                    <figure class="image-upload shadow bg-white">
                                        <input onchange="previewImg(1)" class="img-input" id="file1" type="file"
                                            name="image" id="image" accept="image/jpeg, image/png, image/jpg">
                                        <img class="" src="/images/istockphoto.jpg" id="preview-img"
                                            alt="" style="width: 100%;">
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <select class="form-select shadow-none pointer text-center" id="select-bankname"
                                        name="bankname" required>
                                        <option value="">-- เลือกธนาคาร --</option>
                                        <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                        <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                        <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                        <option value="ธนาคารทหารไทย">ธนาคารทหารไทย</option>
                                        <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                        <option value="ธนาคารกรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
                                        <option value="ธนาคารเกียรตินาคิน">ธนาคารเกียรตินาคิน</option>
                                        <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                                        <option value="ธนาคารซีไอเอ็มบีไทย">ธนาคารซีไอเอ็มบีไทย</option>
                                        <option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
                                        <option value="ธนาคารอาคารสงเคราะห์">ธนาคารอาคารสงเคราะห์</option>
                                        <option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>
                                        <option value="ธนาคารทิสโก้">ธนาคารทิสโก้</option>
                                        <option value="ธนาคารสแตนดาร์ดชาร์เตอร์ด(ไทย)">ธนาคารสแตนดาร์ดชาร์เตอร์ด(ไทย)
                                        </option>
                                        <option value="ธนาคารไทยเครดิตเพื่อรายย่อย">ธนาคารไทยเครดิตเพื่อรายย่อย</option>
                                        <option value="ธนาคารแลนด์แอนด์เฮาส์">ธนาคารแลนด์ แอนด์ เฮาส์</option>
                                        <option value="ธนาคารไอซีบีซี(ไทย)">ธนาคารไอซีบีซี (ไทย)</option>
                                        <option value="ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย">
                                            ธนาคารพัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย</option>
                                        <option value="ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร">
                                            ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร</option>
                                        <option value="ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย">
                                            ธนาคารเพื่อการส่งออกและนำเข้าแห่งประเทศไทย</option>
                                        <option value="ธนาคารอิสลามแห่งประเทศไทย">ธนาคารอิสลามแห่งประเทศไทย</option>
                                        <option value="ธนาคารแห่งประเทศจีน">ธนาคารแห่งประเทศจีน</option>
                                        <option value="ธนาคารซูมิโตโมมิตซุยทรัสต์(ไทย)">ธนาคารซูมิโตโม มิตซุย ทรัสต์ (ไทย)
                                        </option>
                                        <option value="ธนาคารฮ่องกงและเซี้ยงไฮ้แบงกิ้งคอร์ปอเรชั่นจำกัด">
                                            ธนาคารฮ่องกงและเซี้ยงไฮ้แบงกิ้งคอร์ปอเรชั่น จำกัด</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">ชื่อบัญชีธนาคาร</label>
                                <input type="text" name="account_name" id="account-name"
                                    class="form-title form-control shadow-none text-center" required>
                            </div>
                            <div class="col-7 mb-3">
                                <label class="form-label">เลขที่บัญชี</label>
                                <input type="text" name="account_number" id="account-number"
                                    placeholder="123-4-56789-0" class="form-title form-control shadow-none text-center"
                                    required>
                            </div>
                            <div class="col-5 mb-3">
                                <label class="form-label">ลำดับความสำคัญ</label>
                                <input type="number" name="priority" id="priority"
                                    class="form-title form-control shadow-none text-center"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    onKeyPress="if(this.value.length>=10) return false;" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="closeModal()"
                            class="btn-close-modal btn btn-secondary shadow-none" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">บันทึก</button>
                    </div>
                </div>
                <input type="hidden" name="bank_id" id="bank-id">
                <input type="hidden" name="image_path" id="image-path">
            </form>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="/js/backoffice/bank.js"></script> --}}

    <script>
        new DataTable("#admin");

        const modals = document.querySelectorAll(".modal");
        const name = document.querySelectorAll("#name");
        const email = document.querySelectorAll("#email");
        const admin_role = document.querySelectorAll("#admin-role");
        const admin_status = document.querySelectorAll("#admin-status");
        const password = document.querySelectorAll("#password");
        const c_password = document.querySelectorAll("#c_password");
        const cpassword_valid = document.querySelectorAll(".cpassword-valid");
        const password_valid = document.querySelectorAll(".password-valid");

        const admin_id = document.querySelector("#admin-id");
        const close_modal = document.querySelectorAll(".btn-close-modal");

        function closeModal() {
            for (let i = 0; i < modals.length; i++) {
                admin_role[i].value = "";
                admin_status[i].value = "";
                password[i].value = "";
                c_password[i].value = "";
                name[i].value = "";
                email[i].value = "";
            }
        }


        function createAdmin(event) {
            event.preventDefault();

            if (password[0].value.trim().length < 8) {
                password[0].focus();
                password_valid[0].classList.remove('text-secondary')
                password_valid[0].classList.add('text-danger')
                return false;
            } else {
                password_valid[0].classList.remove('text-danger')
                password_valid[0].classList.add('text-secondary')
            }

            if (c_password[0].value !== password[0].value) {
                c_password[0].focus();
                cpassword_valid[0].classList.remove('d-none');
                return false;
            } else {
                cpassword_valid[0].classList.add('d-none');
            }


            return false;

            const form = event.target;
            const formData = new FormData(form);

            axios
                .post("/admin/admin/create", formData)
                .then(({
                    data
                }) => {
                    if (data.status) {
                        close_modal.forEach((btn) => btn.click());
                        toastr.success("เพิ่มผู้ดูแลระบบสำเร็จ");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                })
                .catch((err) => {
                    close_modal.forEach((btn) => btn.click());
                    toastr.error("Error");
                });
        }

        function getAdmin(_id) {
            axios
                .get(`/admin/adminone/${_id}`)
                .then(({
                    data
                }) => {
                    if (data.status) {
                        const bank = data.data;
                        bank_id.value = bank.id;
                        img[1].src = bank.bank_image;
                        select_bank_name[1].value = bank.bank_name;
                        account_name[1].value = bank.account_name;
                        account_number[1].value = bank.account_number;
                        priority[1].value = bank.priority;
                        image_path.value = bank.bank_image;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        }

        function updateAdmin(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            axios
                .post(`/admin/admin/update`, formData)
                .then(({
                    data
                }) => {
                    if (data.status) {
                        close_modal.forEach((btn) => btn.click());
                        toastr.success("Update Admin สำเร็จ");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                })
                .catch((err) => {
                    close_modal.forEach((btn) => btn.click());
                    toastr.error("Error");
                });
        }

        function deleteBank(_el, _id) {
            const url = `/admin/deleteadmin/`;
            onDelete(_el, _id, url);
        }

        function onDelete(_el, _id, _url) {
            Swal.fire({
                text: "คุณต้องการลบใช่หรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`${_url}${_id}`)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                const row = _el.closest("tr");
                                toastr.success("ลบสำเร็จ");
                                if (row) {
                                    // Get the table to which the row belongs
                                    const table = row.closest("table");
                                    // Delete the row from the table
                                    table.deleteRow(row.rowIndex);
                                }
                            }
                        })
                        .catch((err) => {
                            console.log(err.response);
                            toastr.error(err.response.data.description);
                        });
                }
            });
        }

    </script>
@endsection
