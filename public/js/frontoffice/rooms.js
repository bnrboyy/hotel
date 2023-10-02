const urlParams = new URLSearchParams(window.location.search);
const date_checkin = document.getElementById("date-checkin");
const date_checkout = document.getElementById("date-checkout");
const select_adult = document.getElementById("select-adult");
const select_children = document.getElementById("select-children");

function setDateSelected(date_checkin) {
    const checkin = dayjs(date_checkin);
    const tomorrow = checkin.add(1, "day");
    const formatted = tomorrow.format("YYYY-MM-DD");

    date_checkout.setAttribute('min', formatted)
    date_checkout.removeAttribute("disabled");
}

const urls = {
    checkin: urlParams.get('checkin'),
    checkout: urlParams.get('checkout'),
    adult: urlParams.get('adult'),
    children: urlParams.get('children'),
}

const someNullParam = Object.values(urls).some(value => value === null);
console.log(someNullParam)

if (someNullParam) {
    date_checkin.value = "";
    date_checkout.setAttribute('disabled', '')
    select_adult.value = "2";
    select_children.value = "1";
} else {
    date_checkin.value = urls.checkin;
    date_checkout.value = urls.checkout;
    select_adult.value = urls.adult;
    select_children.value = urls.children;

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
        checkin: formData.get('checkin'),
        checkout: formData.get('checkout'),
        adult: formData.get('adult'),
        children: formData.get('children'),
    }

    window.location.href = `/rooms?checkin=${data.checkin}&checkout=${data.checkout}&adult=${data.adult}&children=${data.children}`;
}
