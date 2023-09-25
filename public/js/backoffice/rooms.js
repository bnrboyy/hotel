new DataTable("#rooms");

const features = document.querySelectorAll(".feature-checked");
const facs = document.querySelectorAll(".fac-checked");

const select_feature = document.querySelector(".select-feature");
const select_fac = document.querySelector(".select-fac");

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

    if (feature_length === 0 || fac_length === 0) {
        if (feature_length === 0) {
            select_feature.classList.add("border", "border-danger", "p-2");
        } else {
            select_feature.classList.remove("border", "border-danger", "p-2");
        }

        if (fac_length === 0) {
            select_fac.classList.add("border", "border-danger", "p-2");
        } else {
            select_fac.classList.remove("border", "border-danger", "p-2");
        }

        return false;
    }

}
