@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Quản lý khóa học</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('teacher.index') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('teacher.courses.index', ['teacher' => $teacher->id]) }}">Quản lý khóa học</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('teacher.courses.edit', ['teacher' => $teacher->id, 'course' => $courses->id]) }}">Cập
                    nhật khóa
                    học</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST"
                    action="{{ route('teacher.courses.update', ['teacher' => $teacher->id, 'course' => $courses->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-header">
                        <div class="card-title">Cập nhật thông tin khóa học</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="id_teacher" name="id_teacher" value="{{ $teacher->id }}" />
                            <input type="hidden" id="id_course" name="id_course" value="{{ $courses->id }}" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Tiêu đề khóa học <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $courses->title }}" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="photo">Hình ảnh khóa học: <span class="text-danger">*</span></label>
                                    <input type="hidden" name="hiddenImage">
                                    <input id="photo" type="file" class="form-control" name="photoCourse"
                                        accept="image/*"
                                        onchange="document.getElementById('photoReview').src = window.URL.createObjectURL(this.files[0])" />
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-sm-10">
                                        <input type="hidden" name="old_photo">
                                        <img id="photoReview" class="img img-bordered" style="width:200px"
                                            src="{{ asset('storage/courses/' . $courses->photo) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mô tả khóa học: <span class="text-danger">*</span></label>
                                    <textarea rows="3" class="mb-3 d-none" name="description" id="editor_area">{{ $courses->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ">
                        <a href="{{ route('teacher.courses.index', ['teacher' => $teacher->id]) }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Quay lại danh sách
                        </a>
                        <button type="submit" class="btn btn-success">
                            Lưu dữ liệu
                            <i class="fa fa-save ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="card-title">Danh sách môn học</h3>
                        <button type="button" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Thêm
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-type table-hover">
                        <tbody>
                            @for ($i = 1; $i < 5; $i++)
                                <tr>
                                    <td>
                                        <p>Môn học 1</p>
                                    </td>
                                    <td>It is a long established fact that a reader will be distracted by the readable
                                        content
                                        of a page when looking at its layout. The point of using Lorem Ipsum is that it has
                                        a
                                        more-or-less normal distribution of letters, as opposed to using</td>
                                    <td style="width: 150px">
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.3.0/tinymce.min.js"
        integrity="sha512-RUZ2d69UiTI+LdjfDCxqJh5HfjmOcouct56utQNVRjr90Ea8uHQa+gCxvxDTC9fFvIGP+t4TDDJWNTRV48tBpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/courses.js']);
@endsection
