// new DataTable("#bookings");
$(document).ready(function () {
    $("#booking-all").DataTable({
        order: [], // กำหนด order เป็นรายการว่าง
    });

    $("#booking-online").DataTable({
        order: [], // กำหนด order เป็นรายการว่าง
    });

    $("#booking-walkin").DataTable({
        order: [], // กำหนด order เป็นรายการว่าง
    });

    $("#booking-all_wrapper").removeClass('d-none');
    $("#booking-online_wrapper").addClass('d-none');
    $("#booking-walkin_wrapper").addClass('d-none');

    $(".select-booking-type").change(function () {
        const type = this.value;
        if (type === "all") {
            $("#booking-all_wrapper").removeClass('d-none');
            $("#booking-online_wrapper").addClass('d-none');
            $("#booking-walkin_wrapper").addClass('d-none');

        } else if (type === "online") {
            $("#booking-all_wrapper").addClass('d-none');
            $("#booking-online_wrapper").removeClass('d-none');
            $("#booking-walkin_wrapper").addClass('d-none');

        } else {
            $("#booking-all_wrapper").addClass('d-none');
            $("#booking-online_wrapper").addClass('d-none');
            $("#booking-walkin_wrapper").removeClass('d-none');

        }
    });
});

const formBooking = document.querySelectorAll(".form-booking");
const btn_modal = document.querySelector(".btn-modal");

function updateBookStatus(_el, _id) {
    const badge = _el.closest("td").querySelector(".badge");
    const badge_bg = [
        "bg-warning",
        "bg-primary",
        "bg-info",
        "bg-success",
        "bg-danger",
    ];

    axios
        .post(`/admin/updatebookstatus`, {
            booking_id: parseInt(_id),
            status_id: parseInt(_el.value),
        })
        .then(({ data }) => {
            if (data.status) {
                toastr.success("อัพเดทสถานะสำเร็จ");
                badge_bg.forEach((bg) => {
                    badge.classList.remove(bg);
                });
                badge.classList.add(`bg-${data.booking_status.bg_color}`);
                badge.innerHTML = `${data.booking_status.name} <span><i class="bi bi-caret-down-fill"></i></span>`;

                setTimeout(() => {
                    window.location.reload();
                    // ถ้าสถานะเช็คเอาท์ หรือ ยกเลิก
                    // if ([4, 5].includes(parseInt(data.booking_status.id))) {
                    //     window.location.reload();
                    // }
                }, 2000);
            }
        })
        .catch((err) => console.log(err));
}

function previewSlip(_src) {
    Swal.fire({
        imageUrl: `${_src}`,
        imageWidth: 350,
        // imageHeight: 400,
        imageClass: "slide-img",
        showConfirmButton: false,
        animation: false,
    });
}

function getBooking(_el, _id) {
    axios
        .get(`/admin/bookingone/${_id}`)
        .then(({ data }) => {
            const formData = data.data["formData"];
            formBooking.forEach((form, ind) => {
                form.value = formData[ind];
            });
        })
        .catch((err) => console.log(err));
}

function deleteBook(_el, _id) {
    return;
    axios
        .delete(`/admin/booking/delete/${_id}`)
        .then(({ data }) => {
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
