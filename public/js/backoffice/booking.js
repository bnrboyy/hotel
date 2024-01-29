const urlParams = new URLSearchParams(window.location.search);
const date_checkin = document.getElementById("date-checkin");
const date_checkout = document.getElementById("date-checkout");
const select_adult = document.getElementById("select-adult");
const select_children = document.getElementById("select-children");
const form_search = document.getElementById("form-search");
const btn_search = document.querySelector(".btn-search");
const btn_form_modal = document.querySelector(".btn-form-modal");
const selects = document.querySelectorAll(".select");
let detailsURL = "";

const form_room = document.querySelectorAll(".form-room");
const pre_value = document.querySelectorAll(".pre-value")
const radios = document.querySelectorAll('input[type="radio"]')

const btn_confirm = document.querySelector(".btn-confirm");
const btn_close_modal = document.querySelector(".btn-close-modal");
const loading = document.querySelector(".loading");
const not_available = document.querySelector(".not-available");
const text_confirm = document.querySelector(".text-btn-confirm");


function closeModal() {
    form_room.forEach((el) => {
        el.value = "";
    })

    pre_value.forEach((el) => {
        el.value = "";
    })

    radios[0].checked = true;
    radios[1].checked = false;
}

function setDateSelected(date_checkin) {
    const checkin = dayjs(date_checkin);
    const tomorrow = checkin.add(1, "day");
    const formatted = tomorrow.format("YYYY-MM-DD");

    date_checkout.setAttribute("min", formatted);
    date_checkout.removeAttribute("disabled");
}

const urls = {
    checkin: urlParams.get("checkin"),
    checkout: urlParams.get("checkout"),
    adult: urlParams.get("adult"),
    children: urlParams.get("children"),
};

const someNullParam = Object.values(urls).some((value) => value === null);

if (someNullParam) {
    date_checkin.value = "";
    date_checkout.setAttribute("disabled", "");
    select_adult.value = "2";
    select_children.value = "1";
    detailsURL = "/roomdetails?id=";
} else {
    date_checkin.value = urls.checkin;
    date_checkout.value = urls.checkout;
    select_adult.value = urls.adult;
    select_children.value = urls.children;
    detailsURL = `/roomdetails?checkin=${urls.checkin}&checkout=${urls.checkout}&id=`;
    bookingDetailsURL = `/bookingdetails?checkin=${urls.checkin}&checkout=${urls.checkout}&id=`;

    setDateSelected(urls.checkin);
}

date_checkin.addEventListener("change", function () {
    if (date_checkout.value) {
        date_checkout.value = "";
    }
    setDateSelected(date_checkin.value);
});

function searchrooms(event) {
    event.preventDefault();

    const form = event.target;

    const formData = new FormData(form);

    const data = {
        checkin: formData.get("checkin"),
        checkout: formData.get("checkout"),
        adult: formData.get("adult"),
        children: formData.get("children"),
    };

    window.location.href = `/admin?page=booking&checkin=${data.checkin}&checkout=${data.checkout}&adult=${data.adult}&children=${data.children}`;
}

date_checkout.addEventListener("input", function (event) {
    btn_search.click();
});

selects.forEach((select) => {
    select.addEventListener("input", function () {
        if (date_checkout.value) {
            btn_search.click();
        } else {
            return false;
        }
    });
});

function roomDetails(room_id) {
    window.location.href = `${detailsURL}${room_id}`;
}

function openBookForm(_id) {
    const isNullParams = someNullParam;
    if (isNullParams || !date_checkout.value || !date_checkin.value) {
        Swal.fire({
            icon: "info",
            text: "กรุณาเลือกวัน เช็คอิน - เช็คเอ้าท์",
        }).then(() => {
            return false;
        });
    } else {
        const text_prebooks = document.querySelectorAll(".text-prebook")
        const pre_value = document.querySelectorAll(".pre-value")
        const formData = {
            checkin: date_checkin.value,
            checkout: date_checkout.value,
            id: _id,
        }

        axios
        .post(`/admin/prebooking`, formData)
        .then(({ data }) => {
            text_prebooks.forEach((el, ind) => {
                el.innerHTML = data.preBook[ind]
            })
            pre_value.forEach((el, ind) => {
                el.value = data.preValue[ind]
            })
        }).then(() => {
            btn_form_modal.click();
        })
        .catch((err) => {
            console.log(err);
        });
    }
}




//ปฏิทิน
function generateCalendar(year, month) {
    const calendarContainer = document.getElementById('calendar');
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const firstDayOfMonth = new Date(year, month, 1).getDay();

    let calendarHTML = '<table>';
    calendarHTML += '<tr><th colspan="7">' + new Date(year, month, 1).toLocaleString('en-us', { month: 'long', year: 'numeric' }) + '</th></tr>';
    calendarHTML += '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
    
    let dayCounter = 1;
    for (let i = 0; i < 6; i++) {
      calendarHTML += '<tr>';
      for (let j = 0; j < 7; j++) {
        if (i === 0 && j < firstDayOfMonth) {
          calendarHTML += '<td></td>';
        } else if (dayCounter <= daysInMonth) {
          calendarHTML += '<td>' + dayCounter + '</td>';
          dayCounter++;
        } else {
          calendarHTML += '<td></td>';
        }
      }
      calendarHTML += '</tr>';
    }

    calendarHTML += '</table>';
    calendarContainer.innerHTML = calendarHTML;
  }

  // ให้แสดงปฏิทินสำหรับเดือนและปีปัจจุบัน
  const currentDate = new Date();
  generateCalendar(currentDate.getFullYear(), currentDate.getMonth());




// function book(room_id) {
//     const isNullParams = someNullParam;
//     if (isNullParams || !date_checkout.value || !date_checkin.value) {
//         Swal.fire({
//             icon: "info",
//             text: "กรุณาเลือกวัน เช็คอิน - เช็คเอ้าท์",
//         }).then(() => {
//             return false;
//         });
//     } else {
//         console.log(`${bookingDetailsURL}${room_id}`);
//         window.location.href = `${bookingDetailsURL}${room_id}`;
//     }
// }

function confirmBook(event) {
    event.preventDefault();

 //รับค่า card_id มา
 const card_id = document.querySelector('input[name="card_id"]').value;
 

 if(card_id.length >= 13) {

     const four_id = card_id.slice(-4); //เอาเลข 4 ตัวท้ายมา

     // ใส่ค่า four_id ลงใน <input> ที่มี name เป็น "four_id"
     document.querySelector('input[name="four_id"]').value = four_id;

 }
 else {
     console.log("ความยาวของ card_id ต้องไม่น้อยกว่า 13 ตัว");
     alert("เลขบัตรประชาชนไม่ถูกต้อง");
     document.querySelector('input[name="card_id"]').value = ''; // เคลียร์ค่าใน input
return false;

 }


    const form = event.target;
    const formData = new FormData(form);

    loading.classList.remove('d-none')
    text_confirm.classList.add('d-none')
    btn_confirm.setAttribute('disabled', '')


    axios
        .post(`/admin/confirmbooking`, formData)
        .then(({ data }) => {
            console.log(data)
            setTimeout(() => {
                loading.classList.add('d-none')
                text_confirm.classList.remove('d-none')
                Swal.fire({
                    title: 'จองห้องสำเร็จ!',
                    icon: 'success'
                }).then(() => {
                    btn_close_modal.click()
                    window.location.href = `/admin?page=managebook`;
                })
            }, 1000);
        }).then(() => {
            // btn_form_modal.click();
        })
        .catch(({response}) => {
            setTimeout(() => {
                text_confirm.classList.remove('d-none')
                loading.classList.add('d-none')
                if(response.status === 403) {
                    Swal.fire({
                        title: 'ห้องไม่ว่าง!',
                        icon: 'error'
                    }).then(() => {
                        btn_close_modal.click()
                        window.location.href = `/admin?page=booking`;

                    })
                } else {
                    Swal.fire({
                        title: 'Error!',
                        icon: 'error'
                    }).then(() => {
                        btn_close_modal.click()
                        window.location.href = `/admin?page=booking`;

                    })
                }
            }, 1000);
        })

}
