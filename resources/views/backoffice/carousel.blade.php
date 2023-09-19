@extends('backoffice.layouts.main-layout')

@section('style')
    <link rel="stylesheet" href="css/backoffice/carousel.css">
@endsection

@section('content')
    <h3><i class="bi bi-images"></i> Carousel</h3>

    <div class="d-flex flex-column gap-3">
        <!-- Carousel section -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 mb-4">
                        #รูปภาพทั้งหมด
                    </h5>
                    <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                        data-bs-target="#carousel-s">
                        <i class="bi bi-plus-square"> </i> เพิ่ม
                    </button>
                </div>
                <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4">
                    @foreach ($slide_img as $slide)
                        <div class="col">
                            <div class="card shadow border-0 rounded position-relative">
                                <img src="{{ $slide->image ? $slide->image : '/images/carousel/no-image.png' }}"
                                    onclick="previewSlid('{{ $slide->image }}')" class="card-img-top rounded"
                                    style="width: 100%; height: 155px; cursor: pointer;">
                                <div class="card-body d-flex justify-content-end align-items-center gap-1 position-absolute"
                                    style="z-index: 999; right: 0;">
                                    <button onclick="getById({{ $slide->id }})" type="button"
                                        class="btn btn-warning shadow-none btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit-s">
                                        <i class="bi bi-pen-fill fs-6"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger shadow-none btn-sm"
                                        onclick="onDelete({{ $slide->id }})">
                                        <i class="bi bi-trash-fill fs-6"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Create Modal -->
    <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return onCreate(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">เพิ่มรูปภาพ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-image mb-3">
                                    <figure class="image-upload shadow bg-white">
                                        <input onchange="previewImg()" class="img-input" id="file1" type="file"
                                            name="image" id="image" accept="image/jpeg, image/png, image/jpg"
                                            required>
                                        <img class="" src="/images/carousel/no-image.png" id="preview-img"
                                            alt="" style="width: 100%;">
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">เรียงลำดับความสำคัญ</label>
                                    <input type="number" name="priority" id="priority"
                                        class="form-title form-control text-center shadow-none" value="" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">การแสดงผล</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" id="check-display" type="checkbox" checked>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary shadow-none" data-bs-dismiss="modal"
                            onclick="closeModal()">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">เพิ่ม Carousel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Carousel Edit Modal -->
    <div class="modal fade" id="edit-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form onsubmit="return onUpdate(event)">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">แก้ไขรูปภาพ</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="group-image mb-3">
                                    <input type="hidden" name="carousel_id" id="carousel_id">
                                    <figure class="image-upload shadow bg-white">
                                        <input onchange="previewUpdate()" class="img-input" id="file1"
                                            name="image" type="file" id="image"
                                            accept="image/jpeg, image/png, image/jpg">
                                        <img class="" src="/images/carousel/no-image.png" id="preview-img"
                                            alt="" style="width: 100%;">
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">เรียงลำดับความสำคัญ</label>
                                    <input type="number" name="priority" id="priority"
                                        class="form-title form-control text-center shadow-none" value="" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">การแสดงผล</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" id="check-display"
                                        checked>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary shadow-none"
                            data-bs-dismiss="modal" onclick="closeModal()">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">บันทึกข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const img = document.querySelectorAll('#preview-img')
        const file = document.querySelectorAll("#file1");
        const priority = document.querySelectorAll("#priority");
        const display = document.querySelectorAll("#check-display");
        const carousel_id = document.querySelector("#carousel_id");

        function onCreate(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            formData.append('display', display[0].checked ? 1 : 0)

            axios.post(`/admin/carousel/create`, formData).then(({
                data
            }) => {
                if (data.status) {
                    Swal.fire({
                        icon: "success",
                        title: "เพิ่มสำเร็จ",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        window.location.reload();
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Someting went wrong!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            })
        }

        function onUpdate(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            formData.append('display', display[1].checked ? 1 : 0)

            axios.post(`/admin/carousel/update`, formData).then(({
                data
            }) => {
                if (data.status) {
                    Swal.fire({
                        icon: "success",
                        title: "อัพเดทสำเร็จ",
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(() => {
                        window.location.reload();
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Someting went wrong!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            })
        }

        function previewImg() {
            const image = file[0].files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                img[0].src = reader.result;
            };
            reader.readAsDataURL(image);
        }

        function closeModal() {
            file[0].value = "";
            img[0].src = '/images/carousel/no-image.png'
        }

        function previewSlid(_src) {
            Swal.fire({
                imageUrl: `${_src}`,
                imageWidth: 900,
                imageClass: 'slide-img',
                showConfirmButton: false,
                animation: false,
                width: '950px',
            });
        }

        function onDelete(_id) {
            Swal.fire({
                text: "คุณต้องการลบใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/admin/carousel/delete?id=${_id}`)
                        .then(({
                            data
                        }) => {
                            if (data.status) {
                                Swal.fire({
                                    icon: "success",
                                    title: "ลบสำเร็จ",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(() => {
                                    window.location.reload();
                                });
                            }
                        })
                        .catch((err) => {
                            Swal.fire({
                                icon: "error",
                                title: "Someting went wrong!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            })
        }

        function getById(_id) {
            axios.get(`/admin/carousel/${_id}`).then(({
                data
            }) => {
                if (data.status) {
                    const details = data.data;
                    if (details.image) {
                        img[1].src = details.image;
                    }
                    carousel_id.value = details.id;
                    priority[1].value = details.priority;
                    display[1].checked = details.display;
                }

            }).catch(err => console.log(err))
        }

        function previewUpdate() {
            const image = file[1].files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                img[1].src = reader.result;
            };
            reader.readAsDataURL(image);
        }
    </script>
@endsection
