@extends('backoffice.layouts.main-layout')

@section('style')
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
                    <button type="button" class="btn btn-dark shadow-none btn-sm"
                        data-bs-toggle="modal" data-bs-target="#carousel-s">
                        <i class="bi bi-plus-square"> </i> เพิ่ม
                    </button>
                </div>
                <p class="card-text">เมื่อปิดการใช้งานเว็บไซต์ จะไม่สามารถใช้งานเว็บไซต์ได้</p>
            </div>
        </div>
    </div>

    <!-- Carousel Modal -->
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
                                <div class="mb-3">
                                    <input type="file" name="image" accept="image/*" class="form-title form-control shadow-none"
                                        value="" required>
                                    {{-- <input id="site_id" type="hidden" name="site_id" class="form-control shadow-none"
                                        value="" required> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">ลำดับความสำคัญ</label>
                                    <input type="number" name="priority" class="form-title form-control text-center shadow-none"
                                    value="" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">การแสดงผล</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input shadow-none" type="checkbox" checked>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary shadow-none"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function onCreate() {
            event.preventDefault();

        }
    </script>
@endsection
