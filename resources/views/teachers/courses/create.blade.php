@section('courses_js')
    @vite(['resources/js/courses.js']);
@endsection
@extends('layouts.app')


@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý khóa học</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Quản lý khóa học</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('courses.create', ['teacher' => $teacher->id]) }}">Thêm khóa học</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{ route('courses.store', ['teacher' => $teacher->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <div class="card-title">Tạo mới thông tin khóa học</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="id_teacher" name="id_teacher" value="{{ $teacher->id }}" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tiêu đề khóa học <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="photo">Hình ảnh khóa học: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="hiddenImage">
                                    <input id="photo" type="file" class="form-control" name="photo"
                                        accept="image/*"
                                        onchange="document.getElementById('photoReview').src = window.URL.createObjectURL(this.files[0])" />
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-sm-10">
                                        <input type="hidden" name="old_photo">
                                        <img id="photoReview" class="img img-bordered" style="width:200px"
                                            src="{{ asset('assets/img/default.jpg') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả khóa học: <span class="text-danger">*</span></label>
                                    <div id="quill-editor" class="mb-3">
                                    </div>
                                    <textarea rows="3" class="mb-3 d-none" name="description" id="editor_area"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ">
                        <a href="{{ route('teacher.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Trở về trang chủ
                        </a>
                        <button type="submit" class="btn btn-success">
                            Lưu dữ liệu
                            <i class="fa fa-save ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('tinymce_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js"
        integrity="sha512-RUZ2d69UiTI+LdjfDCxqJh5HfjmOcouct56utQNVRjr90Ea8uHQa+gCxvxDTC9fFvIGP+t4TDDJWNTRV48tBpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
