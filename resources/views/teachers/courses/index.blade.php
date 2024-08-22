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
                <a href="{{ route('teacher.courses.index', ['teacher' => $teacher->id]) }}">Danh sách khóa học</a>
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
                            href="{{ route('teacher.courses.create', ['teacher' => $teacher->id]) }}">
                            <i class="fa fa-plus"></i>
                            Thêm
                        </a>
                    </div>
                </div>
                <div class="row mt-4 mb-2">
                    @if (count($courses) == 0)
                        <h3 class="text-center">Hiện tại không có khóa học nào cả</h3>
                    @else
                        @foreach ($courses as $course)
                            <div class="col-xl-4 col-sm-12 col-md-6">
                                <div class="container course_item">
                                    <div class="card course_item">
                                        <div class="card-header">
                                            <div class="card-head-row card-tools-still-right">
                                                <a href="{{ route('teacher.courses.edit', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                                    class="card-title course_text">{!! Str::limit($course->title, 25) !!}</a>
                                                <div class="card-tools">
                                                    <form
                                                        action="{{ route('teacher.courses.destroy', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('teacher.courses.edit', ['teacher' => $teacher->id, 'course' => $course->id]) }}"
                                                            type="button"
                                                            class="btn btn-link btn-primary btn-lg course_button">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button
                                                            onclick='return confirm("Bạn có chắc chắn muốn xóa khóa học {{ $course->title }} không?")'
                                                            type="submit"
                                                            class="btn btn-link btn-danger btn-lg course_button">
                                                            <i class="fa fa-trash"></i>

                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12"><img
                                                        src="{{ $course->photo ? asset('storage/courses/' . $course->photo) : asset('assets/img/default.jpg') }}"
                                                        class="course_image"></div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="list-group list-group-bubordered">
                                                        <div class="course_description">
                                                            {!! Str::limit($course->description, 35) !!}
                                                        </div>
                                                        <span>Ngày tạo:
                                                            {{ $course->created_at->format('d-m-Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
