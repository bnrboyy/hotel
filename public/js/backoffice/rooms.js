new DataTable("#rooms");

const features = document.querySelectorAll(".feature-checked");
const features_edit = document.querySelectorAll(".featureedit-checked");
const facs = document.querySelectorAll(".fac-checked");
const facs_edit = document.querySelectorAll(".facedit-checked");

const select_feature = document.querySelectorAll(".select-feature");
const select_fac = document.querySelectorAll(".select-fac");

const close_modal = document.querySelectorAll(".btn-close-modal");
const room_checked = document.querySelectorAll(".room-checked");

const room_id = document.querySelector("#room-id");
const room_name = document.querySelector("#room-name");
const room_price = document.querySelector("#room-price");
const room_adult = document.querySelector("#room-adult");
const room_children = document.querySelector("#room-children");
const room_area = document.querySelector("#room-area");

room_checked.forEach((room) => {
    const isChecked = room.getAttribute("isChecked");
    if (parseInt(isChecked) === 1) {
        room.checked = true;
    }
});

function validateRoom(fea_length, fac_length, ind = 0) {
    if (fea_length === 0 || fac_length === 0) {
        if (fea_length === 0) {
            select_feature[ind].classList.add("border", "border-danger", "p-2");
        } else {
            select_feature[ind].classList.remove("border", "border-danger", "p-2");
        }

        if (fac_length === 0) {
            select_fac[ind].classList.add("border", "border-danger", "p-2");
        } else {
            select_fac[ind].classList.remove("border", "border-danger", "p-2");
        }

        return false;
    } else {
        return true;
    }
}

function upd_room_display(_id, _checked) {
    axios
        .patch(`/admin/updateroomdisplay/${_id}`, {
            display: _checked,
        })
        .then(({ data }) => {
            console.log(data);
        })
        .catch((err) => console.log(err));
}

function createRoom(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    features.forEach((feature) => {
        if (feature.checked) {
            formData.append("feature_ids[]", feature.value);
        }
    });

    facs.forEach((fac) => {
        if (fac.checked) {
            formData.append("fac_ids[]", fac.value);
        }
    });

    const feature_length = formData.getAll("feature_ids[]").length;
    const fac_length = formData.getAll("fac_ids[]").length;

    const validator = validateRoom(feature_length, fac_length);

    if (validator) {
        axios
            .post("admin/room/create", formData)
            .then(({ data }) => {
                if (data.status) {
                    close_modal.forEach((btn) => btn.click());
                    toastr.success("เพิ่มห้องพักสำเร็จ");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            })
            .catch((err) => {
                close_modal.forEach((btn) => btn.click());
                toastr.error("Error");
            });
    } else {
        return validator;
    }
}

function getRoom(_id) {
    axios
        .get(`/admin/roomone/${_id}`)
        .then(({ data }) => {
            const room = data.data;
            room_name.value = room.name;
            room_price.value = room.price;
            room_adult.value = room.adult;
            room_children.value = room.children;
            room_area.value = room.area;
            room_id.value = room.id;

            features_edit.forEach((fea) => {
                room.feature_ids.forEach((fea_id) => {
                    if (parseInt(fea_id) === parseInt(fea.value)) {
                        fea.checked = true;
                    }
                });
            });

            facs_edit.forEach((fac) => {
                room.fac_ids.forEach((fac_id) => {
                    if (parseInt(fac_id) === parseInt(fac.value)) {
                        fac.checked = true;
                    }
                });
            });
        })
        .catch((err) => {
            console.log(err);
        });
}

function updateRoom(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    features_edit.forEach((feature) => {
        if (feature.checked) {
            formData.append("feature_ids[]", feature.value);
        }
    });

    facs_edit.forEach((fac) => {
        if (fac.checked) {
            formData.append("fac_ids[]", fac.value);
        }
    });

    const feature_length = formData.getAll("feature_ids[]").length;
    const fac_length = formData.getAll("fac_ids[]").length;

    const validator = validateRoom(feature_length, fac_length, 1);

    if (validator) {
        axios
            .post(`/admin/room/update`, formData)
            .then(({ data }) => {
                if (data.status) {
                    close_modal.forEach((btn) => btn.click());
                    toastr.success("Update Room สำเร็จ");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            })
            .catch((err) => {
                close_modal.forEach((btn) => btn.click());
                toastr.error("Error");
            });
    } else {
        return validator;
    }
}

function closeModal() {
    facs.forEach((fac) => (fac.checked = false));
    features.forEach((fea) => (fea.checked = false));

    facs_edit.forEach((fac) => (fac.checked = false));
    features_edit.forEach((fea) => (fea.checked = false));

    select_fac.forEach(fac => fac.classList.remove("border", "border-danger", "p-2"))
    select_feature.forEach(feature => feature.classList.remove("border", "border-danger", "p-2"))
}
