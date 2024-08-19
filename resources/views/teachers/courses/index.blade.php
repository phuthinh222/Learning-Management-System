@extends('layouts.app')

@section('courses_scss')
    @vite(['resources/css/Teacher/course.scss']);
@endsection

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
                <a href="{{ route('courses.index', ['teacher' => $teacher->id]) }}">Danh sách khóa học</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách khóa học</h4>
                        <a class="btn btn-primary btn-round ms-auto"
                            href="{{ route('courses.create', ['teacher' => $teacher->id]) }}">
                            <i class="fa fa-plus"></i>
                            Thêm khóa học
                        </a>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($courses as $course)
                        <div class="col-sm-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    {{-- <div class="box-title">{{ $course->title }}</div> --}}
                                    <div class="box-tools pull-right">
                                        <a href="{{ route('courses.edit', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                            type="button" class="btn btn-link btn-primary btn-lg">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('courses.edit', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                            type="button" class="btn btn-link btn-primary btn-lg">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-4"><img
                                                src="{{ $course->photo ? asset('storage/courses/' . $course->photo) : asset('assets/img/default.jpg') }}"
                                                class="course_image"></div>
                                        <div class="col-sm-8">
                                            <div class="list-group list-group-bubordered">
                                                <div class="">
                                                    {!! Str::limit($course->description, 100) !!}
                                                </div>
                                                <div class="list-group-item">Ngày tạo:
                                                    {{ $course->created_at->format('d-m-Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class="card-body"> --}}
                {{-- <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>
                                            <img src="{{ $course->photo ? asset('storage/courses/' . $course->photo) : asset('assets/img/default.jpg') }}"
                                                class="course_image">
                                        </td>
                                        <td class="course_content">{{ $course->title }}</td>
                                        <td class="text-break">
                                            {!! Str::limit($course->description, 100) !!}</td>
                                        <td>{{ $course->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('courses.edit', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                                    type="button" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form
                                                    action="{{ route('courses.destroy', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa mục này không?');">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
