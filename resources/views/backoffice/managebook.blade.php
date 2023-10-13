@extends('backoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/backoffice/carousel.css">
@endsection

@section('content')
    <h3><i class="bi bi-images"></i> รายการจอง</h3>

    <div class="d-flex flex-column gap-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-4">
                        #รายการจองทั้งหมด
                    </h5>
                </div>
                <table id="bookings" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>รหัสการจอง</th>
                            <th>เลขอ้างอิง</th>
                            <th>ชื่อผู้จอง</th>
                            <th>ห้อง</th>
                            <th>เช็คอิน - เช็คเอาท์</th>
                            <th>วันเวลาที่จอง</th>
                            <th>จำนวนวัน</th>
                            <th>สถานะการจอง</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>slip</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td style="width: 100px;">{{ $booking->booking_number }}</td>
                                <td style="width: 100px;">{{ $booking->card_id }}</td>
                                <td style="width: 200px;">{{ $booking->cus_fname . ' ' . $booking->cus_lname }}</td>
                                <td style="width: 100px;">{{ $booking->room_name }}</td>
                                <td>
                                    <p>เช็คอิน : {{ $booking->date_checkin }}</p>
                                    <p>เช็คเอาท์ : {{ $booking->date_checkout }}</p>
                                </td>
                                <td style="width: 200px;">{{ $booking->created_at }}</td>
                                <td>{{ $booking->days }}</td>
                                <td><span style="cursor: pointer;"
                                        class="badge rounded-pill text-dark bg-{{ $booking->bg_color }}">{{ $booking->status_name }} <span><i class="bi bi-caret-down-fill"></i></span></span>
                                </td>
                                <td>{{ $booking->cus_phone }}</td>
                                <td><img onclick="previewSlip('{{ $booking->slip }}')" src="{{ $booking->slip }}"
                                        width="100%" style="width: 146px; cursor: pointer;"></td>
                                <td class="">
                                    <div class="w-100 h-100 d-flex flex-column align-items-center gap-2" style="height: 163px;">
                                        <button class="btn-modal btn btn-primary shadow-none" data-bs-toggle="modal"
                                            onclick="getBooking(this, {{ $booking->id }})" data-bs-target="#message-s"><i
                                                class="bi bi-eye-fill"></i></button>
                                        @if ($shareUser->admin_role === 'แอดมินสูงสุด')
                                            <button class="btn btn-danger shadow-none"
                                                onclick="deleteBook(this, {{ $booking->id }})"><i
                                                    class="bi bi-trash-fill"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    {{-- <script src="/js/backoffice/messages.js"></script> --}}

    <script>
        // new DataTable("#bookings");
        $(document).ready(function() {
            $('#bookings').DataTable({
                "order": [] // กำหนด order เป็นรายการว่าง
            });
        });

        const formMsg = document.querySelectorAll(".form-msg");
        const btn_modal = document.querySelector(".btn-modal");

        function previewSlip(_src) {
            Swal.fire({
                imageUrl: `${_src}`,
                imageWidth: 350,
                imageHeight: 400,
                imageClass: "slide-img",
                showConfirmButton: false,
                animation: false,
            });
        }

        function getMessage(_el, _id) {
            const badge = _el.closest("tr").querySelector(".badge");
            axios
                .get(`/admin/messageone/${_id}`)
                .then(({
                    data
                }) => {
                    const formData = data.data["formData"];
                    formMsg.forEach((form, ind) => {
                        form.value = formData[ind];
                    });
                    badge.classList.remove("bg-warning", "text-dark");
                    badge.classList.add("bg-secondary");
                    badge.innerText = "อ่านแล้ว";
                })
                .catch((err) => console.log(err));
        }

        function deleteMessage(_el, _id) {
            axios
                .delete(`/admin/message/delete/${_id}`)
                .then(({
                    data
                }) => {
                    if (data.status) {
                        const row = _el.closest("tr");
                        toastr.success("ลบข้อความสำเร็จ");

                        if (row) {
                            // Get the table to which the row belongs
                            const table = row.closest("table");
                            // Delete the row from the table
                            table.deleteRow(row.rowIndex);
                        }
                    }
                })
                .catch((err) => console.log(err));
        }
    </script>
@endsection
